<?php
include '../../../keamanan/koneksi.php';

// Terima ID masyarakat yang akan dihapus dari formulir HTML
$id_masyarakat = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_masyarakat)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data masyarakat berdasarkan ID
$query_delete_masyarakat = "DELETE FROM masyarakat WHERE id_masyarakat = '$id_masyarakat'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_masyarakat)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
