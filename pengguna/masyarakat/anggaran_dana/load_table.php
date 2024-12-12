                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center column-fixed">Nomor</th>
                                                <th class="text-center column-fixed">Tahun Anggaran</th>
                                                <th class="text-center column-fixed">Jumlah Anggaran</th>
                                                <th class="text-center column-fixed">Sumber Anggaran</th>
                                                <th class="text-center column-fixed">Saldo Kas</th>
                                                <th class="text-center column-fixed">Nama Bidang</th>
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
                                            // Query SQL untuk mengambil data dari tabel anggaran_dana
                                            $query = "SELECT anggaran_dana.*, bidang.nama_bidang AS nama_bidang
                                            FROM anggaran_dana
                                            LEFT JOIN bidang ON anggaran_dana.id_bidang = bidang.id_bidang";
                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE bidang.nama_bidang LIKE '%$search_query%' OR anggaran_dana.tahun_anggaran LIKE '%$search_query%' OR anggaran_dana.jumlah_anggaran LIKE '%$search_query%' OR anggaran_dana.sumber_anggaran LIKE '%$search_query%' OR anggaran_dana.saldo_kas LIKE '%$search_query%'";
                                            }
                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_anggaran_dana DESC";

                                            $result = mysqli_query($koneksi, $query);
                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;
                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tahun_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jumlah_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['sumber_anggaran'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['saldo_kas'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_bidang'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                            \"" . htmlspecialchars($row['id_anggaran_dana'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['jumlah_anggaran'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['sumber_anggaran'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['saldo_kas'], ENT_QUOTES) . "\",
                                                            \"" . htmlspecialchars($row['id_bidang'], ENT_QUOTES) . "\" 
                                                        )'>Edit</button>
                                                    </td>";
                                                    echo "<td class='text-center'>
                                                        <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_anggaran_dana'], ENT_QUOTES) . "\")'>Hapus</button>
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