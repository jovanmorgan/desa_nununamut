<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_program_kerja = $_POST['id_program_kerja'];
$nama_program = $_POST['nama_program'];
$id_anggaran_dana = $_POST['id_anggaran_dana'];
$tujuan_program = $_POST['tujuan_program'];
$periode_pelaksanaan = $_POST['periode_pelaksanaan'];
$id_rab = $_POST['id_rab'];

// Lakukan validasi data
if (empty($nama_program) || empty($id_anggaran_dana) || empty($tujuan_program) || empty($periode_pelaksanaan) || empty($id_rab)) {
    echo "data_tidak_lengkap";
    exit();
}

$tujuan_program_data = str_replace('<br>', "\n", $tujuan_program);
// Format periode_pelaksanaan ke format yang diinginkan
$periode_pelaksanaan_formatted = date('d-M-Y', strtotime($periode_pelaksanaan));

// Buat query SQL untuk memperbarui data kegiatan ke dalam database
$query_update = "UPDATE program_kerja SET 
    nama_program = '$nama_program', 
    id_anggaran_dana = '$id_anggaran_dana', 
    tujuan_program = '$tujuan_program_data', 
    periode_pelaksanaan = '$periode_pelaksanaan_formatted', 
    id_rab = '$id_rab'
    WHERE id_program_kerja = '$id_program_kerja'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
