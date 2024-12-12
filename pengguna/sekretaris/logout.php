<?php
session_start();

// Hapus sesi id_sekretaris jika ada
if (isset($_SESSION['id_sekretaris'])) {
    unset($_SESSION['id_sekretaris']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login_pegunah");
exit;
