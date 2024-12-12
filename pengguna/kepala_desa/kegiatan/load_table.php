                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center column-fixed">Nomor</th>
                                                <th class="text-center column-fixed">Nama Kegiatan</th>
                                                <th class="text-center column-fixed">Waktu</th>
                                                <th class="text-center column-fixed">Lokasi</th>
                                                <th class="text-center column-fixed">Penggunaan Rab</th>
                                                <th class="text-center column-fixed">Tanggal Pelaksanaan Rab</th>
                                                <th class="text-center column-fixed">Nama Bidang</th>
                                                <th class="text-center column-fixed">Status</th>
                                                <th class="text-center column-fixed">Edit</th>
                                                <th class="text-center column-fixed">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../../../keamanan/koneksi.php';
                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                            // Query SQL untuk mengambil data dari tabel kegiatan
                                            $query = "SELECT kegiatan.*, rab.penggunaan AS penggunaan_rab, rab.tgl_pelaksanaan AS tgl_pelaksanaan_rab, rab.tgl_rab AS tgl_rab, bidang.nama_bidang AS nama_bidang
                                                            FROM kegiatan
                                                            LEFT JOIN bidang ON kegiatan.id_bidang = bidang.id_bidang
                                                            LEFT JOIN rab ON kegiatan.id_rab = rab.id_rab";

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE kegiatan.nama_kegiatan LIKE '%$search_query%' OR kegiatan.lokasi LIKE '%$search_query%' OR kegiatan.waktu LIKE '%$search_query%' OR kegiatan.status LIKE '%$search_query%' OR rab.penggunaan LIKE '%$search_query%' OR rab.tgl_pelaksanaan LIKE '%$search_query%' OR rab.tgl_rab LIKE '%$search_query%' OR bidang.nama_bidang LIKE '%$search_query%'";
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_kegiatan DESC";
                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $lokasi_sambung = str_replace(array("\r", "\n"), '', nl2br($row['lokasi']));
                                                    $waktu_input = $row['waktu'];
                                                    $waktu_input_data = date('Y-m-d', strtotime($waktu_input));
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_kegiatan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['waktu'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . $lokasi_sambung . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['penggunaan_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_pelaksanaan_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_bidang'], ENT_QUOTES) . "</td>";
                                                    // Modifikasi bagian tampilan status
                                                    echo "<td class='text-center'>";
                                                    if ($row['status'] == "Telah Dikerjakan") {
                                                        echo "<button class='btn btn-success btn-sm' disabled>Telah Dikerjakan</button>";
                                                    } else {
                                                        echo "<button class='btn btn-info btn-sm' onclick='EditStatus(\"" . htmlspecialchars($row['id_kegiatan'], ENT_QUOTES) . "\")'>Verifikasi</button>";
                                                    }
                                                    echo "</td>";

                                                    echo "<td class='text-center'>
                                                                <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                    \"" . htmlspecialchars($row['id_kegiatan'], ENT_QUOTES) . "\",
                                                                    \"" . htmlspecialchars($row['id_rab'], ENT_QUOTES) . "\",
                                                                    \"" . htmlspecialchars($row['id_bidang'], ENT_QUOTES) . "\",
                                                                    \"" . htmlspecialchars($row['nama_kegiatan'], ENT_QUOTES) . "\",
                                                                    \"" . $lokasi_sambung . "\",
                                                                    \"" . $waktu_input_data . "\"
                                                                )'>Edit</button>
                                                            </td>";
                                                    echo "<td class='text-center'>
                                                                <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_kegiatan'], ENT_QUOTES) . "\")'>Hapus</button>
                                                            </td>";
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