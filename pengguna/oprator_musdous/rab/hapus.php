<?php
include '../../../keamanan/koneksi.php';

// Terima ID rab yang akan dihapus dari formulir HTML
$id_rab = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_rab)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data rab berdasarkan ID
$query_delete_rab = "DELETE FROM rab WHERE id_rab = '$id_rab'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_rab)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
