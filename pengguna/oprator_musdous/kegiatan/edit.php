<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_kegiatan = $_POST['id_kegiatan'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$id_bidang = $_POST['id_bidang'];
$id_rab = $_POST['id_rab'];
$waktu = $_POST['waktu'];
$lokasi = $_POST['lokasi'];

// Buat query SQL untuk memperbarui data kegiatan ke dalam database
$query_update = "UPDATE kegiatan SET 
                    nama_kegiatan = '$nama_kegiatan', 
                    id_bidang = '$id_bidang', 
                    id_rab = '$id_rab', 
                    waktu = '$waktu', 
                    lokasi = '$lokasi'
                WHERE id_kegiatan = '$id_kegiatan'";

// Jalankan query untuk memperbarui data
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
