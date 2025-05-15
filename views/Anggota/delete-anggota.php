<?php
require_once __DIR__ . '/../../models/Anggota.php';

use models\Anggota;

// Cek apakah parameter ID tersedia di URL
if (!isset($_GET['id'])) {
    header("Location: list-anggota.php");
    exit;
}

$id = $_GET['id'];

// Jalankan proses delete
Anggota::delete($id);

// Redirect kembali ke halaman list anggota
header("Location: list-anggota.php");
exit;