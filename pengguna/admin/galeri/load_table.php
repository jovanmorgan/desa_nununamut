<?php
include '../../../keamanan/koneksi.php';
?>

<div id="dataTable" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="places-buttons">
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto text-center">
                                <h2 class="card-title">Data Galeri</h2>
                                <p class="category">Klik untuk menambah data Galeri</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 ml-auto mr-auto">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-block" data-toggle="modal"
                                            data-target="#modalTambah">
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Galeri dari Database -->
        <?php
        // Ambil kata kunci pencarian dari URL jika ada
        $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
        $sql = "SELECT id_galeri, judul, foto, type, deskripsi FROM galeri";
        // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
        if (!empty($search_query)) {
            $sql .= " WHERE judul LIKE '%$search_query%' OR type LIKE '%$search_query%' OR deskripsi LIKE '%$search_query%'";
        }
        // Balik urutan data untuk memunculkan yang paling baru di atas
        $sql .= " ORDER BY id_galeri DESC";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_galeri = $row['id_galeri'];
                $judul = $row['judul'];
                $foto = str_replace('../../../', '../../', $row['foto']);
                $type = $row['type'];
                $deskripsi = str_replace(array("\r", "\n"), '', nl2br($row['deskripsi']));
        ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card card-chart">
                <div class="card-header p-0">
                    <img src="<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($judul); ?>"
                        class="img-fluid img-gallery"
                        onclick="showImageModal('<?php echo htmlspecialchars($foto); ?>', '<?php echo htmlspecialchars($judul); ?>', '<?php echo htmlspecialchars($deskripsi); ?>')">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-category"><?php echo htmlspecialchars($judul); ?></h5>
                    <p class="card-description"><?php echo $deskripsi; ?></p>
                    <button class="btn btn-primary btn-sm"
                        onclick="openEditModal('<?php echo htmlspecialchars($id_galeri); ?>','<?php echo htmlspecialchars($judul); ?>','<?php echo htmlspecialchars($foto); ?>', '<?php echo htmlspecialchars($type); ?>', '<?php echo $deskripsi; ?>')">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="hapus('<?php echo $id_galeri; ?>')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p class='col-12 text-center'>Tidak ada data galeri.</p>";
        }

        $koneksi->close();
        ?>
    </div>
</div>