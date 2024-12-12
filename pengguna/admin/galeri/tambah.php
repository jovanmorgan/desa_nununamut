<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$judul = $_POST['judul'];
$type = $_POST['type'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($judul) || empty($type) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

$kover_name = $_FILES['foto']['name'];
$kover_tmp = $_FILES['foto']['tmp_name'];
$kover_path = '../../../images/galeri/' . basename($kover_name); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp, $kover_path);
// Konversi tag <br> kembali menjadi newline (\n)
$deskripsi_data = str_replace('<br>', "\n", $deskripsi);

// Buat query SQL untuk menambahkan data kegiatan ke dalam database
$query = "INSERT INTO galeri (type, judul, deskripsi, foto) 
        VALUES ('$type', '$judul', '$deskripsi_data', '$kover_path')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);