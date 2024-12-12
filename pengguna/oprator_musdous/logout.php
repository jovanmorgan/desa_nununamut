<?php
session_start();

// Hapus sesi id_oprator_musdous jika ada
if (isset($_SESSION['id_oprator_musdous'])) {
    unset($_SESSION['id_oprator_musdous']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login_pegunah");
exit;
