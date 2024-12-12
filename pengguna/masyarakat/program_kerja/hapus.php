<?php
include '../../../keamanan/koneksi.php';

// Terima ID program_kerja yang akan dihapus dari formulir HTML
$id_program_kerja = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_program_kerja)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data program_kerja berdasarkan ID
$query_delete_program_kerja = "DELETE FROM program_kerja WHERE id_program_kerja = '$id_program_kerja'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_program_kerja)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
