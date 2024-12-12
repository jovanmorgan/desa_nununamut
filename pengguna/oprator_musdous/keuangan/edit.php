<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_keuangan = $_POST['id_keuangan'];
$id_anggaran_dana = $_POST['id_anggaran_dana'];
$tanggal = $_POST['tanggal'];
$nomor_rekening = $_POST['nomor_rekening'];
$jenis_transaksi = $_POST['jenis_transaksi'];
$jumlah = str_replace('.', '', $_POST['jumlah']);
$keterangan = $_POST['keterangan'];

// Lakukan validasi data
if (empty($id_keuangan) || empty($id_anggaran_dana) || empty($tanggal) || empty($nomor_rekening) || empty($jenis_transaksi) || empty($jumlah) || empty($keterangan)) {
    echo "data_tidak_lengkap";
    exit();
}

// Dapatkan data transaksi lama dari tabel keuangan
$query_keuangan = "SELECT * FROM keuangan WHERE id_keuangan = '$id_keuangan'";
$result_keuangan = mysqli_query($koneksi, $query_keuangan);
if (!$result_keuangan) {
    echo "error: " . mysqli_error($koneksi);
    exit();
}
$row_keuangan = mysqli_fetch_assoc($result_keuangan);
$jumlah_lama = str_replace('.', '', $row_keuangan['jumlah']); // Hilangkan titik dari jumlah lama

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
    if ($jumlah > $jumlah_lama) {
        $selisih = $jumlah - $jumlah_lama;
        if ($selisih > $saldo_kas) {
            echo "saldo_kas_tidak_mencukupi";
            exit();
        } else {
            $saldo_kas -= $selisih;
        }
    } else {
        $selisih = $jumlah_lama - $jumlah;
        $saldo_kas += $selisih;
    }
} elseif ($jenis_transaksi == 'Pemasukan') {
    if ($jumlah > $jumlah_lama) {
        $selisih = $jumlah - $jumlah_lama;
        $saldo_kas += $selisih;
        $jumlah_anggaran += $selisih;
    } else {
        $selisih = $jumlah_lama - $jumlah;
        $saldo_kas -= $selisih;
        $jumlah_anggaran -= $selisih;
    }
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

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tanggal));
// Konversi tag <br> kembali menjadi newline (\n)
$keterangan_data = str_replace('<br>', "\n", $keterangan);
$jumlah_formatted = number_format($jumlah, 0, '', '.');

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE keuangan SET id_anggaran_dana = '$id_anggaran_dana', tanggal = '$tanggal_formatted', nomor_rekening = '$nomor_rekening', jenis_transaksi = '$jenis_transaksi', jumlah = '$jumlah_formatted', keterangan = '$keterangan' WHERE id_keuangan = '$id_keuangan'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
