<?php
include '../../../keamanan/koneksi.php';

// Terima ID galeri yang akan dihapus dari formulir HTML
$id_galeri = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_galeri)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mendapatkan path foto yang akan dihapus
$query_get_foto = "SELECT foto FROM galeri WHERE id_galeri = '$id_galeri'";
$result = mysqli_query($koneksi, $query_get_foto);
$row = mysqli_fetch_assoc($result);
$foto_to_delete = $row['foto'];

// Buat query SQL untuk memeriksa apakah ada data lain yang menggunakan file foto yang akan dihapus
$query_check_foto = "SELECT COUNT(*) AS total FROM galeri WHERE foto = '$foto_to_delete'";
$result_check = mysqli_query($koneksi, $query_check_foto);
$row_check = mysqli_fetch_assoc($result_check);
$total_pengguna_foto = $row_check['total'];

// Jika tidak ada data lain yang menggunakan file foto, hapus foto
if ($total_pengguna_foto <= 1) {
    // Hapus file foto dari folder
    unlink($foto_to_delete);
}

// Buat query SQL untuk menghapus data galeri berdasarkan ID
$query_delete_galeri = "DELETE FROM galeri WHERE id_galeri = '$id_galeri'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_galeri)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
