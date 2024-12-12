<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_anggaran_dana = $_POST['id_anggaran_dana'];
$tanggal = $_POST['tanggal'];
$nomor_rekening = $_POST['nomor_rekening'];
$jenis_transaksi = $_POST['jenis_transaksi'];
$jumlah = str_replace('.', '', $_POST['jumlah']); // Hilangkan titik dari jumlah
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_anggaran_dana) || empty($tanggal) || empty($nomor_rekening) || empty($jenis_transaksi) || empty($jumlah) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Dapatkan data saldo_kas dan jumlah_anggaran dari tabel anggaran_dana
$query_anggaran = "SELECT saldo_kas, jumlah_anggaran FROM anggaran_dana WHERE id_anggaran_dana = '$id_anggaran_dana'";
$result_anggaran = mysqli_query($koneksi, $query_anggaran);
if (!$result_anggaran) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}
$row_anggaran = mysqli_fetch_assoc($result_anggaran);
$saldo_kas = str_replace('.', '', $row_anggaran['saldo_kas']); // Hilangkan titik dari saldo_kas
$jumlah_anggaran = str_replace('.', '', $row_anggaran['jumlah_anggaran']); // Hilangkan titik dari jumlah_anggaran

// Logika berdasarkan jenis transaksi
if ($jenis_transaksi == 'Pengeluaran') {
    if ($jumlah > $saldo_kas) {
        echo "saldo_kas_tidak_mencukupi";
        exit();
    } else {
        $saldo_kas -= $jumlah;
    }
} elseif ($jenis_transaksi == 'Pemasukan') {
    $saldo_kas += $jumlah;
    $jumlah_anggaran += $jumlah;
}

// Format kembali saldo_kas dan jumlah_anggaran dengan titik sebagai pemisah ribuan
$saldo_kas_formatted = number_format($saldo_kas, 0, '', '.');
$jumlah_anggaran_formatted = number_format($jumlah_anggaran, 0, '', '.');

// Update saldo_kas dan jumlah_anggaran di tabel anggaran_dana
$query_update_anggaran = "UPDATE anggaran_dana SET saldo_kas = '$saldo_kas_formatted', jumlah_anggaran = '$jumlah_anggaran_formatted' WHERE id_anggaran_dana = '$id_anggaran_dana'";
if (!mysqli_query($koneksi, $query_update_anggaran)) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tanggal));
// Konversi tag <br> kembali menjadi newline (\n)
$keterangan_data = str_replace('<br>', "\n", $keterangan);
$jumlah_formatted = number_format($jumlah, 0, '', '.'); // Format jumlah dengan titik sebagai pemisah ribuan

// Buat query SQL untuk menambahkan data ke dalam tabel keuangan
$query = "INSERT INTO keuangan (id_anggaran_dana, tanggal, nomor_rekening, jenis_transaksi, jumlah, keterangan) 
          VALUES ('$id_anggaran_dana', '$tanggal_formatted', '$nomor_rekening', '$jenis_transaksi', '$jumlah_formatted', '$keterangan')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
