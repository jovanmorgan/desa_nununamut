<?php
include '../../../keamanan/koneksi.php';

// Terima ID realisasi yang akan dihapus dari formulir HTML
$id_realisasi = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_realisasi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data realisasi berdasarkan ID
$query_delete_realisasi = "DELETE FROM realisasi WHERE id_realisasi = '$id_realisasi'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_realisasi)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
