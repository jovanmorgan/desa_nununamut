<?php
include '../../../keamanan/koneksi.php';

// Terima ID kegiatan yang akan dihapus dari formulir HTML
$id_kegiatan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_kegiatan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data kegiatan berdasarkan ID
$query_delete_kegiatan = "DELETE FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_kegiatan)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
