<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Website Desa Nununamut</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/logo.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: Regna
    Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body translate="no">

    <!--==========================
  Header
  ============================-->
    <header id="header">
        <div class="container">
            <div id="logo" class="pull-left">
                <a href="#hero">
                    <img src="img/logo 2.png" class="gambar" alt="" title="" />
                </a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="#hero">Home</a></li>
                    <li><a href="#profile">Profile</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#contact">Contak</a></li>
                    <li><a href="../berlangganan/login_pegunah">Login</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!--==========================
    Hero Section
  ============================-->
    <section id="hero">
        <div class="hero-container">
            <h1>Selamat Datang</h1>
            <h2>Di Website Desa Nununamut</h2>
            <a href="#about" class="btn-get-started">Lanjut</a>
        </div>
    </section><!-- #hero -->

    <main id="main">
        <!--==========================
  About Us Section
============================-->
        <section id="about">
            <div class="container" id="profile">
                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">
                        <h2 class="title">Dana Desa Nununamat</h2>
                        <p>
                            Dana Desa adalah dana yang bersumber dari anggaran APBN pendapatan Negara yang diperuntukkan
                            bagi desa yang ditransfer melalui Anggaran Belanja Daerah dan pendapatan dari kabupaten.
                            Dana ini digunakan untuk membiayai penyelenggaraan pembangunan serta pemberdayaan masyarakat
                            dan kemasyarakatan.
                        </p>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon"><i class="fa fa-university"></i></div>
                            <h4 class="title"><a href="">Sumber Dana</a></h4>
                            <p class="description">Dana desa selain didanai oleh APBN, juga dialokasikan pada bagian
                                anggaran kementerian/lembaga dan disalurkan melalui satuan kerja perangkat daerah
                                Kabupaten/Kota.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon"><i class="fa fa-cogs"></i></div>
                            <h4 class="title"><a href="">Jenis Bantuan</a></h4>
                            <p class="description">Jenis bantuan dana desa berupa pemberdayaan, pembangunan, bidang
                                pembinaan kemasyarakatan, dan bidang kemasyarakatan.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon"><i class="fa fa-credit-card"></i></div>
                            <h4 class="title"><a href="">Pengelolaan Dana</a></h4>
                            <p class="description">Pengelolaan Dana Desa meliputi perencanaan, pelaksanaan,
                                penatausahaan, pelaporan, dan pertanggungjawaban keuangan desa.</p>
                        </div>
                    </div>

                    <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"
                        style="background-image: url('img/bg1.jpg'); background-size: cover; background-position: center;">
                    </div>
                </div>
            </div>
        </section><!-- #about -->
        <!--==========================
  Gallery Section
============================-->
        <section id="portfolio">
            <div class="container wow fadeInUp" id="berita">
                <div class="section-header">
                    <h3 class="section-title">Galeri</h3>
                    <p class="section-description">Berbagai kegiatan dan hasil pembangunan di Desa Nununamat</p>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <ul id="portfolio-flters">
                            <li data-filter=".filter-pembangunan, .filter-pemberdayaan, .filter-kemasyarakatan"
                                class="filter-active">Semua</li>
                            <li data-filter=".filter-pembangunan">Pembangunan</li>
                            <li data-filter=".filter-pemberdayaan">Pemberdayaan</li>
                            <li data-filter=".filter-kemasyarakatan">Kemasyarakatan</li>
                        </ul>
                    </div>
                </div>

                <div class="row" id="portfolio-wrapper">
                    <?php
          include '../keamanan/koneksi.php';

          $sql = "SELECT id_galeri, judul, foto, type, deskripsi FROM galeri ORDER BY id_galeri DESC";
          $result = $koneksi->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id_galeri = $row['id_galeri'];
              $judul = $row['judul'];
              $type = $row['type'];
              $foto = str_replace('../../../', '../', $row['foto']);
              $deskripsi = str_replace(array("\r", "\n"), '', nl2br($row['deskripsi']));
          ?>
                    <div class="col-lg-3 col-md-6 portfolio-item filter-<?php echo htmlspecialchars($type); ?>">
                        <a href="javascript:void(0);"
                            onclick="showImageModal('<?php echo htmlspecialchars($foto); ?>', '<?php echo htmlspecialchars($judul); ?>', '<?php echo htmlspecialchars($deskripsi); ?>')">
                            <img src="<?php echo htmlspecialchars($foto); ?>"
                                alt="<?php echo htmlspecialchars($judul); ?>" style="width: 100%;">
                            <div class="details">
                                <h4><?php echo htmlspecialchars($judul); ?></h4>
                                <span><?php echo htmlspecialchars($deskripsi); ?></span>
                            </div>
                        </a>
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
        </section><!-- #portfolio -->

        <!-- Modal untuk menampilkan gambar besar -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" alt="" class="img-fluid">
                        <p id="modalDescription"></p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function showImageModal(imgSrc, imgTitle, imgDesc) {
            var modal = $('#imageModal');
            modal.find('#modalImage').attr('src', imgSrc);
            modal.find('.modal-title').text(imgTitle);
            modal.find('#modalDescription').text(imgDesc);
            modal.modal('show');
        }
        </script>


        <!--==========================
  Contact Section
============================-->
        <section id="contact">
            <div class="container wow fadeInUp">
                <div class="section-header">
                    <h3 class="section-title">Lokasi</h3>
                    <p class="section-description">Temukan lokasi Kantor Desa Nununamat di peta berikut.</p>
                </div>
            </div>

            <!-- Peta Google dengan lokasi Desa Nununamat -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.0920106363267!2d124.5315852!3d-9.9962174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c5600202bc16467%3A0xad46394aff5cd9dc!2sKantor%20Desa%20Nununamat!5e0!3m2!1sen!2sid!4v1690756257934!5m2!1sen!2sid"
                width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

        </section><!-- #contact -->


    </main>

    <!--==========================
    Footer
  ============================-->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Desa Nununamut</strong>. Dibuat Olleh Fero
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>

</html>