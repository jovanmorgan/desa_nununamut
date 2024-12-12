<?php
// Lakukan koneksi ke database
include '../../../keamanan/koneksi.php';

// Cek apakah terdapat data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $id_oprator_musdous = $_POST['id_oprator_musdous'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($nama) || empty($username) || empty($password)) {
        echo "data tidak lengkap";
        exit();
    }
    // Cek apakah username sudah ada di database
    $check_query = "SELECT * FROM masyarakat WHERE username = '$username'";
    $result = mysqli_query($koneksi, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
    // Cek apakah username sudah ada di database
    $check_query_oprator_musdous = "SELECT * FROM oprator_musdous WHERE username = '$username' AND id_oprator_musdous != '$id_oprator_musdous'";
    $result_oprator_musdous = mysqli_query($koneksi, $check_query_oprator_musdous);
    if (mysqli_num_rows($result_oprator_musdous) > 0) {
        echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
    // Cek apakah username sudah ada di database
    $check_query_kepala_desa = "SELECT * FROM kepala_desa WHERE username = '$username'";
    $result_kepala_desa = mysqli_query($koneksi, $check_query_kepala_desa);
    if (mysqli_num_rows($result_kepala_desa) > 0) {
        echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
    // Cek apakah username sudah ada di database
    $check_query_sekretaris = "SELECT * FROM sekretaris WHERE username = '$username'";
    $result_sekretaris = mysqli_query($koneksi, $check_query_sekretaris);
    if (mysqli_num_rows($result_sekretaris) > 0) {
        echo "error_username_exists"; // Kirim respon "error_email_exists" jika email sudah terdaftar
        exit();
    }
    // Query SQL untuk update data foto profile
    $query = "UPDATE oprator_musdous SET username='$username', password='$password', nama='$nama' WHERE id_oprator_musdous='$id_oprator_musdous'";

    // Lakukan proses update data foto profile di database
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses update data foto profile: " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, berikan respons yang sesuai
    echo "Invalid request method";
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
