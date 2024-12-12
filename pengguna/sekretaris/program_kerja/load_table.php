                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center column-fixed">Nomor</th>
                                                <th class="text-center column-fixed">Nama Program</th>
                                                <th class="text-center column-fixed">Tahun Anggaran</th>
                                                <th class="text-center column-fixed">Jumlah Anggaran</th>
                                                <th class="text-center column-fixed">Tujuan Program</th>
                                                <th class="text-center column-fixed">Periode Pelaksanaan</th>
                                                <th class="text-center column-fixed">Penggunaan Rab</th>
                                                <th class="text-center column-fixed">Tanggal Pelaksanaan Rab</th>
                                                <th class="text-center column-fixed">Nama Bidang</th>
                                                <th class="text-center column-fixed">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../../../keamanan/koneksi.php';

                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                            // Query SQL untuk mengambil data dari tabel program_kerja
                                            $query = "SELECT program_kerja.*, anggaran_dana.tahun_anggaran AS tahun_anggaran, anggaran_dana.jumlah_anggaran AS jumlah_anggaran, anggaran_dana.saldo_kas AS sisah_saldo_kas, rab.penggunaan AS penggunaan_rab, rab.tgl_pelaksanaan AS tgl_pelaksanaan_rab, rab.tgl_rab AS tgl_rab, bidang.nama_bidang AS nama_bidang
                                                            FROM program_kerja
                                                            LEFT JOIN anggaran_dana ON program_kerja.id_anggaran_dana = anggaran_dana.id_anggaran_dana
                                                            LEFT JOIN bidang ON anggaran_dana.id_bidang = bidang.id_bidang
                                                            LEFT JOIN rab ON program_kerja.id_rab = rab.id_rab";

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE program_kerja.nama_program LIKE '%$search_query%' OR program_kerja.tujuan_program LIKE '%$search_query%' OR program_kerja.periode_pelaksanaan LIKE '%$search_query%' OR program_kerja.status LIKE '%$search_query%' OR anggaran_dana.tahun_anggaran LIKE '%$search_query%' OR anggaran_dana.jumlah_anggaran LIKE '%$search_query%' OR anggaran_dana.saldo_kas LIKE '%$search_query%' OR rab.penggunaan LIKE '%$search_query%' OR rab.tgl_pelaksanaan LIKE '%$search_query%' OR rab.tgl_rab LIKE '%$search_query%' OR bidang.nama_bidang LIKE '%$search_query%'";
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_program_kerja DESC";
                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $tujuan_program_sambung = str_replace(array("\r", "\n"), '', nl2br($row['tujuan_program']));
                                                    $periode_pelaksanaan_input = $row['periode_pelaksanaan'];
                                                    $periode_pelaksanaan_input_data = date('Y-m-d', strtotime($periode_pelaksanaan_input));
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_program'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tahun_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jumlah_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . $tujuan_program_sambung . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['periode_pelaksanaan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['penggunaan_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_pelaksanaan_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_bidang'], ENT_QUOTES) . "</td>";
                                                    // Modifikasi bagian tampilan status
                                                    echo "<td class='text-center'>";
                                                    if ($row['status'] == "Telah Diverifikasi") {
                                                        echo "<button class='btn btn-success btn-sm' disabled>Telah Diverifikasi</button>";
                                                    } else {
                                                        echo "<button class='btn btn-info btn-sm' onclick='EditStatus(\"" . htmlspecialchars($row['id_program_kerja'], ENT_QUOTES) . "\")'>Verifikasi</button>";
                                                    }
                                                    echo "</td>";
                                                    echo "</tr>";
                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<td class='text-center' colspan='7'><h3>Gagal mengambil data dari database</h3></td>";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
                                            ?>
                                        </tbody>
                                    </table>