<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
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
$periode_pelaksanaan_formatted = date('d-M-Y', strtotime($periode_pelaksanaan));

// Buat query SQL untuk menambahkan data program ke dalam database
$query = "INSERT INTO program_kerja (nama_program, id_anggaran_dana, tujuan_program, periode_pelaksanaan, id_rab) 
          VALUES ('$nama_program', '$id_anggaran_dana', '$tujuan_program_data', '$periode_pelaksanaan_formatted', '$id_rab')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
