<?php
include '../../../keamanan/koneksi.php';

// Terima ID bidang yang akan dihapus dari formulir HTML
$id_bidang = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_bidang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data bidang berdasarkan ID
$query_delete_bidang = "DELETE FROM bidang WHERE id_bidang = '$id_bidang'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_bidang)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
