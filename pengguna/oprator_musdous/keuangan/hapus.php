<?php
include '../../../keamanan/koneksi.php';

// Terima ID keuangan yang akan dihapus dari formulir HTML
$id_keuangan = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_keuangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Dapatkan data transaksi yang akan dihapus dari tabel keuangan
$query_keuangan = "SELECT * FROM keuangan WHERE id_keuangan = '$id_keuangan'";
$result_keuangan = mysqli_query($koneksi, $query_keuangan);
if (!$result_keuangan) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}
$row_keuangan = mysqli_fetch_assoc($result_keuangan);
$id_anggaran_dana = $row_keuangan['id_anggaran_dana'];
$jenis_transaksi = $row_keuangan['jenis_transaksi'];
$jumlah = str_replace('.', '', $row_keuangan['jumlah']);

// Dapatkan data saldo_kas dan jumlah_anggaran dari tabel anggaran_dana
$query_anggaran = "SELECT saldo_kas, jumlah_anggaran FROM anggaran_dana WHERE id_anggaran_dana = '$id_anggaran_dana'";
$result_anggaran = mysqli_query($koneksi, $query_anggaran);
if (!$result_anggaran) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}
$row_anggaran = mysqli_fetch_assoc($result_anggaran);
$saldo_kas = str_replace('.', '', $row_anggaran['saldo_kas']);
$jumlah_anggaran = str_replace('.', '', $row_anggaran['jumlah_anggaran']);

// Logika berdasarkan jenis transaksi
if ($jenis_transaksi == 'Pengeluaran') {
    $saldo_kas += $jumlah;
} elseif ($jenis_transaksi == 'Pemasukan') {
    $saldo_kas -= $jumlah;
    $jumlah_anggaran -= $jumlah;
}

// Format saldo_kas dan jumlah_anggaran kembali ke format dengan tanda titik
$saldo_kas_formatted = number_format($saldo_kas, 0, ',', '.');
$jumlah_anggaran_formatted = number_format($jumlah_anggaran, 0, ',', '.');

// Update saldo_kas dan jumlah_anggaran di tabel anggaran_dana
$query_update_anggaran = "UPDATE anggaran_dana SET saldo_kas = '$saldo_kas_formatted', jumlah_anggaran = '$jumlah_anggaran_formatted' WHERE id_anggaran_dana = '$id_anggaran_dana'";
if (!mysqli_query($koneksi, $query_update_anggaran)) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}

// Buat query SQL untuk menghapus data keuangan berdasarkan ID
$query_delete_keuangan = "DELETE FROM keuangan WHERE id_keuangan = '$id_keuangan'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_keuangan)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
