<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$status = $_POST['status'];
$id_kegiatan = $_POST['id_kegiatan'];
$biaya = $_POST['biaya']; // Menghapus titik dari format biaya
$tahun_realisasi = date('Y'); // Mendapatkan tahun saat ini

// Lakukan validasi data
if (empty($status) || empty($id_kegiatan) || empty($biaya)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data realisasi ke dalam database
$query = "INSERT INTO realisasi (status, id_kegiatan, biaya, tahun_realisasi) 
        VALUES ('$status', '$id_kegiatan', '$biaya', '$tahun_realisasi')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
