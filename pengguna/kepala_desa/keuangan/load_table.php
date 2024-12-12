                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center column-fixed">Nomor</th>
                                                <th class="text-center column-fixed">Tahun Anggaran</th>
                                                <th class="text-center column-fixed">Jumlah Anggaran</th>
                                                
                                                <th class="text-center column-fixed">Tanggal</th>
                                                <th class="text-center column-fixed">Nomor Rekening</th>
                                                <th class="text-center column-fixed">Jenis Transaksi</th>
                                                <th class="text-center column-fixed">Jumlah Transaksi</th>
                                                <th class="text-center column-fixed">Keterangan</th>
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
                                            // Query SQL untuk mengambil data dari tabel keuangan
                                            $query = "SELECT keuangan.*, anggaran_dana.tahun_anggaran AS tahun_anggaran, anggaran_dana.jumlah_anggaran AS jumlah_anggaran, anggaran_dana.saldo_kas AS sisah_saldo_kas
                                            FROM keuangan
                                            LEFT JOIN anggaran_dana ON keuangan.id_anggaran_dana = anggaran_dana.id_anggaran_dana";
                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE anggaran_dana.tahun_anggaran LIKE '%$search_query%' OR anggaran_dana.jumlah_anggaran LIKE '%$search_query%' OR anggaran_dana.saldo_kas LIKE '%$search_query%' OR keuangan.tanggal LIKE '%$search_query%' OR keuangan.nomor_rekening LIKE '%$search_query%' OR keuangan.jenis_transaksi LIKE '%$search_query%' OR keuangan.jumlah LIKE '%$search_query%' OR keuangan.keterangan LIKE '%$search_query%'";
                                            }
                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_keuangan DESC";

                                            $result = mysqli_query($koneksi, $query);
                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;
                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $keterangan_sambung = str_replace(array("\r", "\n"), '', nl2br($row['keterangan']));
                                                    $tanggal_input = $row['tanggal'];
                                                    $tanggal_input_data = date('Y-m-d', strtotime($tanggal_input));
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tahun_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jumlah_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tanggal'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nomor_rekening'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jenis_transaksi'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jumlah'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['keterangan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                            \"" . htmlspecialchars($row['id_keuangan'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['id_anggaran_dana'], ENT_QUOTES) . "\",
                                                           \"" . $tanggal_input_data . "\",
                                                            \"" . htmlspecialchars($row['nomor_rekening'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['jenis_transaksi'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['jumlah'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($keterangan_sambung, ENT_QUOTES) . "\"
                                                        )'>Edit</button>
                                                    </td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_keuangan'], ENT_QUOTES) . "\")'>Hapus</button>
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