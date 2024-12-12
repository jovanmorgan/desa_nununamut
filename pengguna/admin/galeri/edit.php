<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_galeri = $_POST['id_galeri'];
$judul = $_POST['judul'];
$type = $_POST['type'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($id_galeri) || empty($judul) || empty($type) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Proses upload file
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $kover_name = $_FILES['foto']['name'];
    $kover_tmp = $_FILES['foto']['tmp_name'];
    $kover_path = '../../../images/galeri/' . basename($kover_name);

    // Simpan file foto di folder tujuan
    if (move_uploaded_file($kover_tmp, $kover_path)) {
        // File berhasil diupload, lanjutkan dengan update database
    } else {
        echo "error";
        exit();
    }
} else {
    // Jika tidak ada file baru yang diupload, tetap gunakan foto yang lama
    $kover_path = '';
}

// Konversi tag <br> kembali menjadi newline (\n)
$deskripsi_data = str_replace('<br>', "\n", $deskripsi);

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE galeri SET type = '$type', judul = '$judul', deskripsi = '$deskripsi_data'";

// Tambahkan kolom foto jika ada file baru yang diupload
if (!empty($kover_path)) {
    $query_update .= ", foto = '$kover_path'";
}

$query_update .= " WHERE id_galeri = '$id_galeri'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
