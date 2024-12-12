<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_masyarakat'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../berlangganan/login_pegunah");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman masyarakat.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo_dinas.png">
    <title>
        DATA PROGRAM KERJA
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body translate="no" class="white-content">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper badge-success">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <img src="../../images/logo_dinas.png" width="50px" alt="" style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 14px; font-weight: bold; font-style: italic; right: 5px; color: #ffffff;" translate="no">
                        Desa Nununamat
                    </a>

                </div>
                <ul class="nav">
                    <li>
                        <a href="./dashboard">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./masyarakat_data_program_kerja">
                            <i class="tim-icons icon-notes"></i> <!-- Ikon catatan -->
                            <p>Program Kerja</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./masyarakat_data_Report">
                            <i class="tim-icons icon-chart-bar-32"></i>
                            <p>Data</p>
                        </a>
                    </li>
                    <br>
                    <br>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Masyarakat</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../keamanan/koneksi.php';

                                        // Periksa apakah session id_masyarakat telah diset
                                        if (isset($_SESSION['id_masyarakat'])) {
                                            $id_masyarakat = $_SESSION['id_masyarakat'];

                                            // Query SQL untuk mengambil data masyarakat berdasarkan id_masyarakat dari session
                                            $query = "SELECT * FROM masyarakat WHERE id_masyarakat = '$id_masyarakat'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data masyarakat
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data masyarakat sebagai array asosiatif
                                                    $masyarakat = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($masyarakat['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $masyarakat['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $masyarakat['id_masyarakat']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data masyarakat
                                                    echo "Tidak ada data masyarakat.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data masyarakat: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_masyarakat tidak diset
                                            echo "Session id_masyarakat tidak tersedia.";
                                        }

                                        // Tutup koneksi ke database
                                        mysqli_close($koneksi);
                                        ?>

                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Log out
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="foto_profile" class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="GET">
                            <div class="modal-header">
                                <input type="text" name="search_query" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->

            <!-- Modal Tambah Data Tamabh -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambah" style="font-size: 250%;">Tambah
                                Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan data tambah -->
                            <form id="form_tambah" action="program_kerja/tambah.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_program">Nama Program:</label>
                                    <input type="text" class="form-control" id="nama_program" name="nama_program" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggaran_dana">Anggaran Dana :</label>
                                    <select class="form-control" id="id_anggaran_dana" name="id_anggaran_dana" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data anggaran_dana
                                        $query = "SELECT id_anggaran_dana, jumlah_anggaran, sumber_anggaran, saldo_kas FROM anggaran_dana";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_anggaran_dana'] . "'> Anggaran : " . $row['jumlah_anggaran'] . " | Sumber : " . $row['sumber_anggaran'] . " | Sisa : " . $row['saldo_kas'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tujuan_program">Tujuan Program: :</label>
                                    <textarea class="form-control" id="tujuan_program" name="tujuan_program" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="periode_pelaksanaan">periode Pelaksanaan:</label>
                                    <input type="date" class="form-control" id="periode_pelaksanaan" name="periode_pelaksanaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_rab">rab:</label>
                                    <select class="form-control" id="id_rab" name="id_rab" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data rab
                                        $query = "SELECT id_rab, penggunaan FROM rab";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_rab'] . "'>" . $row['penggunaan'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 250%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan atau mengedit data program_kerja -->
                            <form id="form_edit" action="update_program_kerja.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="editid_program_kerja" name="id_program_kerja">
                                <div class="form-group">
                                    <label for="editnama_program">Nama Program:</label>
                                    <input type="text" class="form-control" id="editnama_program" name="nama_program" required>
                                </div>
                                <div class="form-group">
                                    <label for="editid_anggaran_dana">Anggaran Dana :</label>
                                    <select class="form-control" id="editid_anggaran_dana" name="id_anggaran_dana" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data anggaran_dana
                                        $query = "SELECT id_anggaran_dana, jumlah_anggaran, sumber_anggaran, saldo_kas FROM anggaran_dana";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_anggaran_dana'] . "'> Anggaran : " . $row['jumlah_anggaran'] . " | Sumber : " . $row['sumber_anggaran'] . " | Sisa : " . $row['saldo_kas'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edittujuan_program">Tujuan Program:</label>
                                    <textarea class="form-control" id="edittujuan_program" name="tujuan_program" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editperiode_pelaksanaan">Periode Pelaksanaan:</label>
                                    <input type="date" class="form-control" id="editperiode_pelaksanaan" name="periode_pelaksanaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="editid_rab">RAB:</label>
                                    <select class="form-control" id="editid_rab" name="id_rab" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data rab
                                        $query = "SELECT id_rab, penggunaan FROM rab";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_rab'] . "'>" . $row['penggunaan'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openEditModal(id_program_kerja, nama_program, id_anggaran_dana, tujuan_program, periode_pelaksanaan, id_rab, status) {
                    // Isi data ke dalam form edit
                    var tujuan_program_data = tujuan_program.replace(/<br\s*\/?>/gi, '\n');
                    document.getElementById('editid_program_kerja').value = id_program_kerja;
                    document.getElementById('editnama_program').value = nama_program;
                    document.getElementById('editid_anggaran_dana').value = id_anggaran_dana;
                    document.getElementById('edittujuan_program').value = tujuan_program_data;
                    document.getElementById('editperiode_pelaksanaan').value = periode_pelaksanaan;
                    document.getElementById('editid_rab').value = id_rab;
                    $('#editModal').modal('show');
                }
            </script>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Program Kerja
                                            </h2>

                                            <p class="category">Clik untuk menambah data Program Kerja</p>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambah">Tambah </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .column-fixed {
                            white-space: nowrap;
                        }

                        .column-wide {
                            white-space: nowrap;
                            min-width: 200px;
                            /* Sesuaikan dengan kebutuhan Anda */
                        }
                    </style>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../../keamanan/koneksi.php';

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .button-like {
                    display: inline-block;
                    padding: 7px 20px;
                    background-color: #007bff;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    cursor: default;
                    color: #fff;
                }
            </style>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="nav">

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                About Us
                            </a>
                        </li>

                    </ul>
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Dibuat Oleh Fero
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--=============== LOADING ===============-->
    <div class="loading">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <style>
        .loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            /* Mula-mula, loading disembunyikan */
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Menempatkan loading di atas elemen lain */
            height: 100vh;
            width: 100vw;
            background-color: rgba(255, 255, 255, 0.932);
            /* Menambahkan latar belakang semi transparan */
        }

        .circle {
            width: 20px;
            height: 20px;
            background-color: #41a506;
            border-radius: 50%;
            margin: 0 10px;
            animation: bounce 0.5s infinite alternate;
        }

        .circle:nth-child(2) {
            animation-delay: 0.2s;
        }

        .circle:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-20px);
            }
        }
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const loding = document.querySelector('.loading');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_tambah').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'program_kerja/tambah.php', true);
                xhr.onload = function() {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        console.log(response); // Debugging

                        if (response === 'success') {
                            form.reset();
                            $('#modalTambah').modal('hide');
                            loadTable();
                            swal("Berhasil!", "Data berhasil ditambahkan", "success").then(() => {});
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "info");
                        } else if (response === 'error_username_exists') {
                            swal("Error", "Data Username Sudah Ada Silakan Gunakan data Username lain", "info");
                        } else if (response === 'nik_belum_pas') {
                            swal("Nomor Registrasi Salah!", "Nomor Registrasi harus lebih dari 12 karakter", "info");
                        } else if (response === 'error_password_length') {
                            swal("Password Salah!", "Password harus lebih dari 8 karakter", "info");
                        } else if (response === 'error_password_strength') {
                            swal("Password Lemah!", "Password harus mengandung huruf besar, huruf kecil, dan angka", "info");
                        } else {
                            swal("Error", "Gagal menambahkan data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        // logika untuk mengedit Data
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_edit').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'program_kerja/edit.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        console.log(response); // Debugging

                        if (response === 'success') {
                            form.reset();
                            $('#editModal').modal('hide');
                            loadTable();
                            swal("Berhasil!", "Data berhasil diedit", "success").then(() => {});
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "info");
                        } else if (response === 'error_username_exists') {
                            swal("Error", "Data Username Sudah Ada Silakan Gunakan data Username lain", "info");
                        } else if (response === 'nik_belum_pas') {
                            swal("Nomor Registrasi Salah!", "Nomor Registrasi harus lebih dari 12 karakter", "info");
                        } else if (response === 'error_password_length') {
                            swal("Password Salah!", "Password harus lebih dari 8 karakter", "info");
                        } else if (response === 'error_password_strength') {
                            swal("Password Lemah!", "Password harus mengandung huruf besar, huruf kecil, dan angka", "info");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        function EditStatus(id) {
            swal({
                title: "Apakah Anda yakin?",
                text: "Setelah diverifikasi, Data akan permanen diverifikasi!",
                icon: "info",
                buttons: ["Batal", "Ya, setuju!"],
                infoMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Kirim data ke backend untuk diverifikasi
                    fetch('program_kerja/edit_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=' + id,
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.text();
                        })
                        .then(result => {
                            if (result === 'success') {
                                swal("Sukses!", "Data berhasil diverifikasi.", "success");
                                loadTable();
                            } else {
                                swal("Error", "Gagal mengdiverifikasi Data.", "error");
                            }
                        })
                        .catch(error => {
                            swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
                        });
                } else {
                    // Jika pengguna membatalkan verifikasi
                    swal("Verifikasi dibatalkan", {
                        icon: "info",
                    });
                }
            });
        }

        // logika untuk menghapus data video
        function hapus(id) {
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: ["Batal", "Ya, hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna mengonfirmasi untuk menghapus
                        var xhr = new XMLHttpRequest();

                        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                        loding.style.display = 'flex';

                        xhr.open('POST', 'program_kerja/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data berhasil dihapus.", "success")
                                    loadTable();
                                } else {
                                    swal("Error", "Gagal menghapus Data.", "error");
                                }
                            } else {
                                swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
                            }
                        };
                        xhr.send("id=" + id);
                    } else {
                        // Jika pengguna membatalkan penghapusan
                        swal("Penghapusan dibatalkan", {
                            icon: "info",
                        });
                    }
                });
        }


        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'program_kerja/load_table.php', true);
            xhrTable.send();
        }
    </script>


    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="../../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>
</body>

</html>