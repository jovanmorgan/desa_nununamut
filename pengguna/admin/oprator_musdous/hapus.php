<?php
include '../../../keamanan/koneksi.php';

// Terima ID oprator_musdous yang akan dihapus dari formulir HTML
$id_oprator_musdous = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_oprator_musdous)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data oprator_musdous berdasarkan ID
$query_delete_oprator_musdous = "DELETE FROM oprator_musdous WHERE id_oprator_musdous = '$id_oprator_musdous'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_oprator_musdous)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
