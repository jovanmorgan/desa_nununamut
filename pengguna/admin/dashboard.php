<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../berlangganan/login_pegunah");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo_dinas.png">
    <title>
        Desa Nununamat | Admin Dashboard
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
                    <li class="active">
                        <a href="./dashboard">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_kepala_desa">
                            <i class="tim-icons icon-single-02"></i> <!-- Ikon orang -->
                            <p>Kepala Desa</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_sekretaris">
                            <i class="tim-icons icon-badge"></i> <!-- Ikon lencana -->
                            <p>Sekretaris</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_masyarakat">
                            <i class="fas fa-users"></i> <!-- Ikon kelompok orang -->
                            <p>Masyarakat</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_oprator_musdous">
                            <i class="fas fa-users"></i> <!-- Ikon kelompok orang -->
                            <p>Oprator Musdous</p>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="./admin_data_anggaran_dana">
                            <i class="tim-icons icon-coins"></i> <!-- Ikon koin -->
                            <p>Anggaran Dana</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_program_kerja">
                            <i class="tim-icons icon-notes"></i> <!-- Ikon catatan -->
                            <p>Program Kerja</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_kegiatan">
                            <i class="tim-icons icon-calendar-60"></i> <!-- Ikon kalender -->
                            <p>Kegiatan</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_realisasi">
                            <i class="tim-icons icon-check-2"></i> <!-- Ikon ceklis -->
                            <p>Realisasi</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_bidang">
                            <i class="tim-icons icon-align-center"></i> <!-- Ikon penyelarasan -->
                            <p>Bidang</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_rab">
                            <i class="tim-icons icon-paper"></i> <!-- Ikon dokumen -->
                            <p>Rab</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_galeri">
                            <i class="fas fa-images"></i> <!-- Ikon dokumen -->
                            <p>Galeri</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./admin_data_Report">
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Admin</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../keamanan/koneksi.php';

                                        // Periksa apakah session id_admin telah diset
                                        if (isset($_SESSION['id_admin'])) {
                                            $id_admin = $_SESSION['id_admin'];

                                            // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
                                            $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data admin
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data admin sebagai array asosiatif
                                                    $admin = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($admin['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $admin['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $admin['id_admin']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data admin
                                                    echo "Tidak ada data admin.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_admin tidak diset
                                            echo "Session id_admin tidak tersedia.";
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
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 class="card-title stylish-title">
                                                Selamat Datang Di Website Dana Desa Nununamat
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .stylish-title {
                            font-family: 'Arial Black', Gadget, sans-serif;
                            font-size: 2em;
                            color: #2c3e50;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
                            background: linear-gradient(to right, #19f373, #19f373);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            padding: 10px 0;
                            width: 100%;
                        }

                        .card-chart {
                            transition: transform 0.3s, box-shadow 0.3s;
                            cursor: pointer;
                        }

                        .card-chart:hover {
                            transform: translateY(-10px);
                            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                        }

                        .card-category {
                            font-weight: bold;
                            color: #00c853;
                        }

                        .card-title i {
                            font-size: 2em;
                            margin-right: 10px;
                            color: #b2ff59;
                        }

                        .card-body p {
                            margin: 0;
                            font-size: 1.1em;
                        }
                    </style>

                    <!-- Section for Total Dashboard -->
                    <?php
                    // Include the database connection file
                    include '../../keamanan/koneksi.php';

                    // Define queries for each table
                    $queries = [
                        "SELECT COUNT(*) AS total FROM kepala_desa",
                        "SELECT COUNT(*) AS total FROM sekretaris",
                        "SELECT COUNT(*) AS total FROM masyarakat",
                        "SELECT COUNT(*) AS total FROM anggaran_dana",
                        "SELECT COUNT(*) AS total FROM program_kerja",
                        "SELECT COUNT(*) AS total FROM kegiatan",
                        "SELECT COUNT(*) AS total FROM realisasi",
                        "SELECT COUNT(*) AS total FROM bidang",
                        "SELECT COUNT(*) AS total FROM rab"
                    ];

                    // Initialize the total count
                    $total_count = 0;

                    // Execute each query and add the count to the total
                    foreach ($queries as $query) {
                        $result = mysqli_query($koneksi, $query);
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_count += $row['total'];
                        }
                    }

                    // Close the database connection
                    mysqli_close($koneksi);
                    ?>
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./dashboard'">
                            <div class="card-header">
                                <h5 class="card-category">Total Semua Data</h5>
                                <h3 class="card-title"><i class="tim-icons icon-chart-pie-36"></i> <?php echo $total_count; ?> Data</h3>
                            </div>
                            <div class="card-body p-4">
                                Semua Data pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Other cards here -->
                    <!-- Kepala Desa -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_kepala_desa'">
                            <div class="card-header">
                                <h5 class="card-category">Total Kepala Desa</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_kepala_desa = "SELECT COUNT(*) AS total_kepala_desa FROM kepala_desa";
                                $result_count_kepala_desa = mysqli_query($koneksi, $query_count_kepala_desa);

                                if ($result_count_kepala_desa) {
                                    $row_count_kepala_desa = mysqli_fetch_assoc($result_count_kepala_desa);
                                    $total_data_kepala_desa = $row_count_kepala_desa['total_kepala_desa'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-single-02'></i> $total_data_kepala_desa Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Kepala Desa pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Sekretaris -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_sekretaris'">
                            <div class="card-header">
                                <h5 class="card-category">Total Sekretaris</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_sekretaris = "SELECT COUNT(*) AS total_sekretaris FROM sekretaris";
                                $result_count_sekretaris = mysqli_query($koneksi, $query_count_sekretaris);

                                if ($result_count_sekretaris) {
                                    $row_count_sekretaris = mysqli_fetch_assoc($result_count_sekretaris);
                                    $total_data_sekretaris = $row_count_sekretaris['total_sekretaris'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-badge'></i> $total_data_sekretaris Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Sekretaris pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Masyarakat -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_masyarakat'">
                            <div class="card-header">
                                <h5 class="card-category">Total Masyarakat</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_masyarakat = "SELECT COUNT(*) AS total_masyarakat FROM masyarakat";
                                $result_count_masyarakat = mysqli_query($koneksi, $query_count_masyarakat);

                                if ($result_count_masyarakat) {
                                    $row_count_masyarakat = mysqli_fetch_assoc($result_count_masyarakat);
                                    $total_data_masyarakat = $row_count_masyarakat['total_masyarakat'];

                                    echo "<h3 class='card-title'><i class='fas fa-users'></i> $total_data_masyarakat Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Masyarakat pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Anggaran Dana -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_anggaran_dana'">
                            <div class="card-header">
                                <h5 class="card-category">Total Anggaran Dana</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_anggaran_dana = "SELECT COUNT(*) AS total_anggaran_dana FROM anggaran_dana";
                                $result_count_anggaran_dana = mysqli_query($koneksi, $query_count_anggaran_dana);

                                if ($result_count_anggaran_dana) {
                                    $row_count_anggaran_dana = mysqli_fetch_assoc($result_count_anggaran_dana);
                                    $total_data_anggaran_dana = $row_count_anggaran_dana['total_anggaran_dana'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-coins'></i> $total_data_anggaran_dana Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Anggaran Dana pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Program Kerja -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_program_kerja'">
                            <div class="card-header">
                                <h5 class="card-category">Total Program Kerja</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_program_kerja = "SELECT COUNT(*) AS total_program_kerja FROM program_kerja";
                                $result_count_program_kerja = mysqli_query($koneksi, $query_count_program_kerja);

                                if ($result_count_program_kerja) {
                                    $row_count_program_kerja = mysqli_fetch_assoc($result_count_program_kerja);
                                    $total_data_program_kerja = $row_count_program_kerja['total_program_kerja'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-notes'></i> $total_data_program_kerja Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Program Kerja pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Kegiatan -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_kegiatan'">
                            <div class="card-header">
                                <h5 class="card-category">Total Kegiatan</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_kegiatan = "SELECT COUNT(*) AS total_kegiatan FROM kegiatan";
                                $result_count_kegiatan = mysqli_query($koneksi, $query_count_kegiatan);

                                if ($result_count_kegiatan) {
                                    $row_count_kegiatan = mysqli_fetch_assoc($result_count_kegiatan);
                                    $total_data_kegiatan = $row_count_kegiatan['total_kegiatan'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-calendar-60'></i> $total_data_kegiatan Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Kegiatan pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Realisasi -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_realisasi'">
                            <div class="card-header">
                                <h5 class="card-category">Total Realisasi</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_realisasi = "SELECT COUNT(*) AS total_realisasi FROM realisasi";
                                $result_count_realisasi = mysqli_query($koneksi, $query_count_realisasi);

                                if ($result_count_realisasi) {
                                    $row_count_realisasi = mysqli_fetch_assoc($result_count_realisasi);
                                    $total_data_realisasi = $row_count_realisasi['total_realisasi'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-check-2'></i> $total_data_realisasi Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Realisasi pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Bidang -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_bidang'">
                            <div class="card-header">
                                <h5 class="card-category">Total Bidang</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_bidang = "SELECT COUNT(*) AS total_bidang FROM bidang";
                                $result_count_bidang = mysqli_query($koneksi, $query_count_bidang);

                                if ($result_count_bidang) {
                                    $row_count_bidang = mysqli_fetch_assoc($result_count_bidang);
                                    $total_data_bidang = $row_count_bidang['total_bidang'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-align-center'></i> $total_data_bidang Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Bidang pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Rab -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./admin_data_rab'">
                            <div class="card-header">
                                <h5 class="card-category">Total Rab</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_rab = "SELECT COUNT(*) AS total_rab FROM rab";
                                $result_count_rab = mysqli_query($koneksi, $query_count_rab);

                                if ($result_count_rab) {
                                    $row_count_rab = mysqli_fetch_assoc($result_count_rab);
                                    $total_data_rab = $row_count_rab['total_rab'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-paper'></i> $total_data_rab Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data Rab pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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