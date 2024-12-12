<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($username) || empty($password) || empty($nama)) {
    echo "data_tidak_lengkap";
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
$check_query_admin = "SELECT * FROM admin WHERE username = '$username'";
$result_admin = mysqli_query($koneksi, $check_query_admin);
if (mysqli_num_rows($result_admin) > 0) {
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

if (strlen($password) < 8) {
    echo "error_password_length"; // Kirim respon "error_password_length" jika panjang password kurang dari 8 karakter
    exit();
}

// Tambahkan logika untuk memeriksa password
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $password)) {
    echo "error_password_strength"; // Kirim respon "error_password_strength" jika password tidak memenuhi syarat
    exit();
}

// Buat query SQL untuk menambahkan data sekretaris ke dalam database
$query = "INSERT INTO sekretaris (nama, username, password) 
        VALUES ('$nama','$username', '$password')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
