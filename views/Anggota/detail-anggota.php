<?php
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Pegawai.php';
require_once __DIR__ . '/../../models/KartuDiskon.php';

use models\Anggota;
use models\Pegawai;
use models\KartuDiskon;

if (!isset($_GET['id'])) {
    header("Location: list-anggota.php");
    exit;
}

$anggota = Anggota::findWithDetails($_GET['id']);
if (!$anggota) {
    header("Location: list-anggota.php");
    exit;
}

$pegawai = Pegawai::find($anggota['pegawai_id']);
$kartuDiskon = $anggota['kartu_diskon_id'] ? KartuDiskon::getAll($anggota['kartu_diskon_id']) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Detail Anggota</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list-anggota.php">Anggota</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user me-1"></i>
                        Data Anggota
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Status Aktif</th>
                                <td><?= $anggota['status_aktif'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td><?= $pegawai['nip'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><?= $pegawai['nama'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td><?= $pegawai['jenis_kelamin'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td><?= $pegawai['jabatan'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Kartu Diskon</th>
                                <td><?= $kartuDiskon['nama'] ?? '-' ?></td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="list-anggota.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../public/js/scripts.js"></script>
</body>
</html>
