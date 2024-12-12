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
        Desa Nununamat | masyarakat Dashboard
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
                        <img src="../../images/logo_dinas.png" width="50px" alt=""
                            style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative"
                        style="font-size: 14px; font-weight: bold; font-style: italic; right: 5px; color: #ffffff;"
                        translate="no">
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard masyarakat</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                                    <?php if (!empty($masyarakat['fp'])): ?>
                                                        <img class="avatar" src="data_fp/<?php echo $masyarakat['fp']; ?>" alt="...">
                                                    <?php else: ?>
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
                                    <li class="nav-link"><a href="foto_profile"
                                            class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"
                aria-labelledby="searchModal" aria-hidden="true">
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
                        "SELECT COUNT(*) AS total FROM program_kerja"
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
                                <h3 class="card-title"><i class="tim-icons icon-chart-pie-36"></i>
                                    <?php echo $total_count; ?> Data</h3>
                            </div>
                            <div class="card-body p-4">
                                Semua Data pada Sistem Dana Desa Nununamat
                            </div>
                        </div>
                    </div>

                    <!-- Program Kerja -->
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./masyarakat_data_program_kerja'">
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
        $(document).ready(function () {
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