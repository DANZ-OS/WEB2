<?php
require_once __DIR__ . '/../../models/Pembayaran.php';

use models\Pembayaran;

// Validasi input
if (!isset($_GET['id'])) {
    echo "ID pembayaran tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Hapus pesanan utama
if (Pembayaran::delete($id)) {
    // Redirect ke halaman list pesanan setelah berhasil hapus
    header("Location: list-pembayaran.php");
    exit;
} else {
    echo "Gagal menghapus data oembayaran.";
}
