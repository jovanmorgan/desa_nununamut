<?php
include '../../../keamanan/koneksi.php';

// Terima ID sekretaris yang akan dihapus dari formulir HTML
$id_sekretaris = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_sekretaris)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data sekretaris berdasarkan ID
$query_delete_sekretaris = "DELETE FROM sekretaris WHERE id_sekretaris = '$id_sekretaris'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_sekretaris)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
