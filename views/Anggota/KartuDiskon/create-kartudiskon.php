<?php
require_once __DIR__ . '/../../../config/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $persen_diskon = $_POST['persen_diskon'] ?? '';

    if (!empty($nama) && is_numeric($persen_diskon)) {
        $pdo = \config\Connection::make();
        $stmt = $pdo->prepare("INSERT INTO kartu_diskon (nama, deskripsi, persen_diskon) VALUES (?, ?, ?)");
        $stmt->execute([$nama, $deskripsi, (int)$persen_diskon]);

        header("Location: ../create-anggota.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kartu Diskon</title>
    <link href="../../../public/css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Kartu Diskon</h2>
        <form method="POST" action="create-kartudiskon.php">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kartu Diskon</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="persen_diskon" class="form-label">Persen Diskon (%)</label>
                <input type="number" name="persen_diskon" id="persen_diskon" class="form-control" min="0" max="100" required>
            </div>
            <a href="../create-anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
</body>
</html>
