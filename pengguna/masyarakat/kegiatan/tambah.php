<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama_kegiatan = $_POST['nama_kegiatan'];
$id_bidang = $_POST['id_bidang'];
$id_rab = $_POST['id_rab'];
$waktu = $_POST['waktu'];
$lokasi = $_POST['lokasi'];

// Buat query SQL untuk menambahkan data kegiatan ke dalam database
$query_tambah = "INSERT INTO kegiatan (nama_kegiatan, id_bidang, id_rab, waktu, lokasi) 
                VALUES ('$nama_kegiatan', '$id_bidang', '$id_rab', '$waktu', '$lokasi')";

// Jalankan query untuk menambahkan data
if (mysqli_query($koneksi, $query_tambah)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
