<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_program_kerja = $_POST['id'];

// Lakukan validasi data
if (empty($id_program_kerja)) {
    echo "data_tidak_lengkap";
    exit();
}

$status = "Telah Diverifikasi";

// Buat query SQL untuk memperbarui data program kerja ke dalam database
$query_update = "UPDATE program_kerja SET 
    status = '$status'
    WHERE id_program_kerja = '$id_program_kerja'";

// Jalankan query untuk memperbarui data program kerja
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
