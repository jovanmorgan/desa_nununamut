                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center column-fixed">Nomor</th>
                                                <th class="text-center column-fixed">nama Bidang</th>
                                                <th class="text-center column-fixed">Penggunaan</th>
                                                <th class="text-center column-fixed">Status</th>
                                                <th class="text-center column-fixed">Keterangan</th>
                                                <th class="text-center column-fixed">tgl_pelaksanaan Pelaksanaan</th>
                                                <th class="text-center column-fixed">tgl_pelaksanaan RAB</th>
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
                                            // Query SQL untuk mengambil data dari tabel rab
                                            $query = "SELECT rab.*, bidang.nama_bidang AS nama_bidang
                                            FROM rab
                                            LEFT JOIN bidang ON rab.id_bidang = bidang.id_bidang";
                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE bidang.nama_bidang LIKE '%$search_query%' OR rab.tahun_anggaran LIKE '%$search_query%' OR rab.jumlah_anggaran LIKE '%$search_query%' OR rab.sumber_anggaran LIKE '%$search_query%' OR rab.saldo_kas LIKE '%$search_query%'";
                                            }
                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_rab DESC";

                                            $result = mysqli_query($koneksi, $query);
                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;
                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $tgl_pelaksanaan_input = $row['tgl_pelaksanaan'];
                                                    $tgl_pelaksanaan_input_data = date('Y-m-d', strtotime($tgl_pelaksanaan_input));
                                                    $tgl_rab_input = $row['tgl_rab'];
                                                    $tgl_rab_input_data = date('Y-m-d', strtotime($tgl_rab_input));
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_bidang'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['penggunaan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['status'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['keterangan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_pelaksanaan'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_rab'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['active'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                            \"" . htmlspecialchars($row['id_rab'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['id_bidang'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['penggunaan'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['status'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['keterangan'], ENT_QUOTES) . "\",
                                                           \"" . $tgl_pelaksanaan_input_data . "\",
                                                           \"" . $tgl_rab_input_data . "\",
                                                            \"" . htmlspecialchars($row['active'], ENT_QUOTES) . "\" 
                                                        )'>Edit</button>
                                                    </td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_rab'], ENT_QUOTES) . "\")'>Hapus</button>
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