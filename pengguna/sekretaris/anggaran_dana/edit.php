<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_anggaran_dana = $_POST['id_anggaran_dana'];
$jumlah_anggaran = $_POST['jumlah_anggaran'];
$sumber_anggaran = $_POST['sumber_anggaran'];
$saldo_kas = $_POST['saldo_kas'];
$id_bidang = $_POST['id_bidang'];

// Lakukan validasi data
if (empty($id_anggaran_dana) || empty($jumlah_anggaran) || empty($sumber_anggaran) || empty($saldo_kas) || empty($id_bidang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Dapatkan tahun saat ini
$tahun_anggaran = date('Y');

if ($jumlah_anggaran < $saldo_kas) {
    echo "data_anggaran_salah";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE anggaran_dana SET jumlah_anggaran = '$jumlah_anggaran', sumber_anggaran = '$sumber_anggaran', saldo_kas = '$saldo_kas', id_bidang = '$id_bidang' WHERE id_anggaran_dana = '$id_anggaran_dana'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
