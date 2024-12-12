<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama_bidang = $_POST['nama_bidang'];

// Lakukan validasi data
if (empty($nama_bidang)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data bidang ke dalam database
$query = "INSERT INTO bidang (nama_bidang) 
        VALUES ('$nama_bidang')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
