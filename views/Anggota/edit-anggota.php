<?php
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';

use models\Anggota;
use models\Pegawai;
use models\KartuDiskon;

if(!isset($_GET['id'])){
    header("Location: list-anggota.php");
    exit;
}

$anggota = Anggota::findWithDetails($_GET['id']);

if(!$anggota){
    header("Location: list-anggota.php");
    exit; 
}

$pegawaiList = Pegawai::getAllBelumJadiAnggota();
$kartuDiskonList = KartuDiskon::getAll();

if (isset($_POST['submit'])) {
    $data = [
        'id' => $_GET['id'],
        'status_aktif' => isset($_POST['status_aktif']) ? 1 : 0,
        'pegawai_id' => $_POST['pegawai_id'],
        'kartu_diskon_id' => $_POST['kartu_diskon_id'],
    ];

    Anggota::update($ID, $data);
    header("Location: list-anggota.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Edit Anggota</h1>
    <form method="POST" action="edit-anggota.php?id=<?= $anggota['id'] ?>">
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status_aktif" name="status_aktif" <?= $anggota['status_aktif'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="status_aktif">Status Aktif</label>
        </div>

        <div class="mb-3">
            <label for="pegawai_id" class="form-label">Pegawai</label>
            <select class="form-select" name="pegawai_id" id="pegawai_id" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach ($pegawaiList as $pegawai): ?>
                    <option value="<?= $pegawai['id'] ?>" <?= $pegawai['id'] == $anggota['pegawai_id'] ? 'selected' : '' ?>>
                        <?= $pegawai['nama'] ?> (<?= $pegawai['nip'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kartu_diskon_id" class="form-label">Kartu Diskon</label>
            <select class="form-select" name="kartu_diskon_id" id="kartu_diskon_id">
                <option value="">-- Pilih Kartu Diskon --</option>
                <?php foreach ($kartuDiskonList as $diskon): ?>
                    <option value="<?= $diskon['id'] ?>" <?= $diskon['id'] == $anggota['kartu_diskon_id'] ? 'selected' : '' ?>>
                        <?= $diskon['kode'] ?> - <?= $diskon['jenis'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <a href="list-anggota.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</body>
</html>
