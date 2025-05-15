<?php
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/DetailPesanan.php';

use models\Pesanan;
use models\DetailPesanan;

// Validasi input
if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Hapus dulu semua detail pesanan
DetailPesanan::deleteByPesananId($id);

// Hapus pesanan utama
if (Pesanan::delete($id)) {
    // Redirect ke halaman list pesanan setelah berhasil hapus
    header("Location: list-pesanan.php");
    exit;
} else {
    echo "Gagal menghapus pesanan.";
}
