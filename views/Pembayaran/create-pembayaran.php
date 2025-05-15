<?php
require_once '../../config/Connection.php';
require_once '../../models/Pesanan.php';
require_once '../../models/Pembayaran.php';

use models\Pesanan;
use models\Pembayaran;

$daftarPesanan = Pesanan::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
    $jumlah = $_POST['jumlah'];

    // Panggil metode create dengan array data yang sesuai dengan struktur database
    Pembayaran::create([
        'pesanan_id' => $id_pesanan,
        'tanggal' => $tanggal_pembayaran,
        'jumlah_bayar' => $jumlah
    ]);

    header("Location: list-pembayaran.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tambah Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Top Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Sidebar + Content -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link active" href="list-pembayaran.php">
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

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pembayaran.php">Pembayaran</a></li>
                        <li class="breadcrumb-item active">Tambah Pembayaran</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-money-check-alt me-1"></i>
                            Form Pembayaran
                        </div>
                        <div class="card-body">
                            <form method="POST" action="create-pembayaran.php">
                                <div class="mb-3">
                                    <label for="id_pesanan" class="form-label">Pesanan</label>
                                    <select class="form-select" id="id_pesanan" name="id_pesanan" required>
                                        <option value="">-- Pilih Pesanan --</option>
                                        <?php foreach ($daftarPesanan as $pesanan): ?>
                                            <option value="<?= $pesanan['id'] ?>">#<?= $pesanan['id'] ?> - <?= $pesanan['tanggal'] ?> - <?= $pesanan['nama_pegawai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                </div>

                                <a href="list-pembayaran.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Project 1 <?= date('Y') ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>