<?php
session_start();

// Hapus sesi id_masyarakat jika ada
if (isset($_SESSION['id_masyarakat'])) {
    unset($_SESSION['id_masyarakat']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login_pegunah");
exit;
