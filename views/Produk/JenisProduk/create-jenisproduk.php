<?php
require_once __DIR__ . '/../../../models/JenisProduk.php';

use models\JenisProduk;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    if (!empty($nama)) {
        $pdo = \config\Connection::make();
        $stmt = $pdo->prepare("INSERT INTO jenis_produk (nama, deskripsi) VALUES (?, ?)");
        $stmt->execute([$nama, $deskripsi]);

        header("Location: ../create-produk.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jenis Produk</title>
    <link href="../../../public/css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Jenis Produk</h2>
        <form method="POST" action="create-jenisproduk.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Jenis Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <a href="../create-produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
</body>
</html>
