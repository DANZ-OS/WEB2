<?php
require_once __DIR__ . '/../../models/Pembayaran.php';
require_once __DIR__ . '/../../models/Pesanan.php';

use models\Pembayaran;
use models\Pesanan;

if (!isset($_GET['id'])) {
    header("Location: list-pembayaran.php");
    exit;
}

$pembayaran = Pembayaran::findById($_GET['id']);

if (!$pembayaran) {
    header("Location: list-pembayaran.php");
    exit;
}

// Ambil data pesanan untuk dropdown
$daftarPesanan = Pesanan::getAll();

if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $data = [
        'tanggal' => $_POST['tanggal'],
        'jumlah_bayar' => $_POST['jumlah_bayar']
    ];

    Pembayaran::update($id, $data);
    header("Location: list-pembayaran.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Koperasi - Edit Pembayaran</title>
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
                        <a class="nav-link" href="list-pembayaran.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                            Pembayaran
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Zaidaan A Dzihnie
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pembayaran.php">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Edit Pembayaran</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Form Edit Pembayaran
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="pesanan_id" class="form-label">Pesanan</label>
                                    <select class="form-select" id="pesanan_id" name="pesanan_id" required>
                                        <option value="">-- Pilih Pesanan --</option>
                                        <?php foreach ($daftarPesanan as $pesanan): ?>
                                            <option value="<?= $pesanan['id'] ?>" <?= $pesanan['id'] == $pembayaran['pesanan_id'] ? 'selected' : '' ?>>
                                                #<?= $pesanan['id'] ?> - <?= $pesanan['tanggal'] ?> - <?= $pesanan['nama_pegawai'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($pembayaran['tanggal']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="<?= htmlspecialchars($pembayaran['jumlah_bayar']) ?>" required>
                                </div>

                                <a href="list-pembayaran.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Project 1 <?= date('Y') ?></div>
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