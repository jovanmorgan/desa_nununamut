<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_bidang = $_POST['id_bidang'];
$penggunaan = $_POST['penggunaan'];
$status = $_POST['status'];
$tgl_pelaksanaan = $_POST['tgl_pelaksanaan'];
$tgl_rab = $_POST['tgl_rab'];
$active = $_POST['active'];
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_bidang) || empty($penggunaan) || empty($status) || empty($tgl_pelaksanaan) || empty($tgl_rab) || empty($active) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted1 = date('d-M-Y', strtotime($tgl_pelaksanaan));
// Format tanggal ke format yang diinginkan
$tanggal_formatted2 = date('d-M-Y', strtotime($tgl_rab));
// Buat query SQL untuk menambahkan data kegiatan ke dalam database
$query = "INSERT INTO rab (id_bidang, penggunaan, status, tgl_pelaksanaan, tgl_rab, active, keterangan) 
        VALUES ('$id_bidang', '$penggunaan', '$status', '$tanggal_formatted1', '$tanggal_formatted2', '$active', '$keterangan')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
