<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_realisasi = $_POST['id_realisasi'];
$status = $_POST['status'];
$id_kegiatan = $_POST['id_kegiatan'];
$biaya = $_POST['biaya'];  // Menghapus titik dari format biaya
$tahun_realisasi = date('Y'); // Mendapatkan tahun saat ini

// Lakukan validasi data
if (empty($id_realisasi) || empty($status) || empty($id_kegiatan) || empty($biaya)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE realisasi SET status = '$status', id_kegiatan = '$id_kegiatan', biaya = '$biaya', tahun_realisasi = '$tahun_realisasi' WHERE id_realisasi = '$id_realisasi'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
