<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_rab = $_POST['id_rab'];
$id_bidang = $_POST['id_bidang'];
$penggunaan = $_POST['penggunaan'];
$status = $_POST['status'];
$tgl_pelaksanaan = $_POST['tgl_pelaksanaan'];
$tgl_rab = $_POST['tgl_rab'];
$active = $_POST['active'];
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_rab) || empty($id_bidang) || empty($penggunaan) || empty($status) || empty($tgl_pelaksanaan) || empty($tgl_rab) || empty($active) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted1 = date('d-M-Y', strtotime($tgl_pelaksanaan));
$tanggal_formatted2 = date('d-M-Y', strtotime($tgl_rab));

// Buat query SQL untuk memperbarui data kegiatan ke dalam database
$query_update = "UPDATE rab SET 
    id_bidang = '$id_bidang', 
    penggunaan = '$penggunaan', 
    status = '$status', 
    tgl_pelaksanaan = '$tanggal_formatted1', 
    tgl_rab = '$tanggal_formatted2', 
    active = '$active', 
    keterangan = '$keterangan' 
    WHERE id_rab = '$id_rab'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
