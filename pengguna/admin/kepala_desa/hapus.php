<?php
include '../../../keamanan/koneksi.php';

// Terima ID kepala_desa yang akan dihapus dari formulir HTML
$id_kepala_desa = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_kepala_desa)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data kepala_desa berdasarkan ID
$query_delete_kepala_desa = "DELETE FROM kepala_desa WHERE id_kepala_desa = '$id_kepala_desa'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_kepala_desa)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
