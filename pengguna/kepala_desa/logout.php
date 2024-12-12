<?php
session_start();

// Hapus sesi id_kepala_desa jika ada
if (isset($_SESSION['id_kepala_desa'])) {
    unset($_SESSION['id_kepala_desa']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login_pegunah");
exit;
