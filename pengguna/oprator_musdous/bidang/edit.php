<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_bidang = $_POST['id_bidang'];
$nama_bidang = $_POST['nama_bidang'];

// Lakukan validasi data
if (empty($nama_bidang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE bidang SET nama_bidang = '$nama_bidang' WHERE id_bidang = '$id_bidang'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
