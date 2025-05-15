<?php
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/Anggota.php';

use models\Pesanan;
use models\Anggota;

if (!isset($_GET['id'])) {
    header("Location: list-pesanan.php");
    exit;
}

$pesanan = Pesanan::findWithDetails($_GET['id']);
$anggota_list = Anggota::getWithDetails($pesanan['anggota_id']);

if (!$pesanan) {
    header("Location: list-pesanan.php");
    exit;
}

if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $status_bayar = ($_POST['status_pesanan'] === 'lunas') ? 1 : 0;

    $data = [
        'id' => $id,
        'anggota_id' => $_POST['anggota_id'],
        'tanggal' => $_POST['tanggal'],
        'diskon' => isset($_POST['diskon']) ? $_POST['diskon'] : 0,
        'status_bayar' => $status_bayar
    ];

    Pesanan::update($id, $data);
    header("Location: list-pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Koperasi - Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                            Pesanan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Zaidaan A Dzihnie
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pesanan.php">Pesanan</a></li>
                        <li class="breadcrumb-item active">Edit Pesanan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Form Edit Pesanan
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="anggota_id" class="form-label">Nama Anggota</label>
                                    <select class="form-select" id="anggota_id" name="anggota_id" required>
                                        <option value="">-- Pilih Anggota --</option>
                                        <?php foreach ($anggota_list as $anggota): ?>
                                            <option value="<?= $anggota['anggota_id'] ?>" <?= $anggota['anggota_id'] == $pesanan['anggota_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($anggota['nama_pegawai']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($pesanan['tanggal']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status_pesanan" class="form-label">Status Bayar</label>
                                    <select class="form-select" id="status_pesanan" name="status_pesanan" required>
                                        <option value="belum_lunas" <?= $pesanan['status_bayar'] === '0' ? 'selected' : '' ?>>Belum Lunas</option>
                                        <option value="lunas" <?= $pesanan['status_bayar'] == 1 ? 'selected' : ''?>>Lunas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="diskon" class="form-label">Diskon (%)</label>
                                    <input type="number" class="form-control" id="diskon" name="diskon" value="<?= htmlspecialchars($pesanan['diskon']) ?>" min="0" max="100"> 
                                </div>

                                <a href="list-pesanan.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; DANZ COMPANY <?= date('Y') ?></div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../public/js/scripts.js"></script>
</body>
</html>
