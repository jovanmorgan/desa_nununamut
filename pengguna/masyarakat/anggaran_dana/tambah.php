<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$jumlah_anggaran = $_POST['jumlah_anggaran'];
$sumber_anggaran = $_POST['sumber_anggaran'];
$saldo_kas = $_POST['saldo_kas'];
$id_bidang = $_POST['id_bidang'];

// Lakukan validasi data
if (empty($jumlah_anggaran) || empty($sumber_anggaran) || empty($saldo_kas) || empty($id_bidang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Dapatkan tahun saat ini
$tahun_anggaran = date('Y');

if ($jumlah_anggaran < $saldo_kas) {
    echo "data_anggaran_salah"; 
    exit();
}

// Buat query SQL untuk menambahkan data kegiatan ke dalam database
$query = "INSERT INTO anggaran_dana (tahun_anggaran, jumlah_anggaran, sumber_anggaran, saldo_kas, id_bidang) 
        VALUES ('$tahun_anggaran', '$jumlah_anggaran', '$sumber_anggaran', '$saldo_kas', '$id_bidang')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
