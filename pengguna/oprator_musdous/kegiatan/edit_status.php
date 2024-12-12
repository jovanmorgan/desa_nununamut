<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_kegiatan = $_POST['id'];

// Lakukan validasi data
if (empty($id_kegiatan)) {
    echo "data_tidak_lengkap";
    exit();
}

$status = "Telah Dikerjakan";

// Buat query SQL untuk memperbarui data program kerja ke dalam database
$query_update = "UPDATE kegiatan SET 
    status = '$status'
    WHERE id_kegiatan = '$id_kegiatan'";

// Jalankan query untuk memperbarui data program kerja
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
