<?php
include '../../../keamanan/koneksi.php';

// Terima ID anggaran_dana yang akan dihapus dari formulir HTML
$id_anggaran_dana = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_anggaran_dana)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data anggaran_dana berdasarkan ID
$query_delete_anggaran_dana = "DELETE FROM anggaran_dana WHERE id_anggaran_dana = '$id_anggaran_dana'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_anggaran_dana)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
