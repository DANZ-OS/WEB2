<?php
require_once __DIR__ . '/../../models/Pembayaran.php';
require_once __DIR__ . '/../../models/Pesanan.php';

use models\Pembayaran;
use models\Pesanan;

if (!isset($_GET['id'])) {
    header("Location: list-pembayaran.php");
    exit;
}

// Ambil data pembayaran dengan detailnya
$pembayaran = Pembayaran::findById($_GET['id']);

if (!$pembayaran) {
    header("Location: list-pembayaran.php");
    exit;
}

// Ambil data pesanan terkait
$pesanan = Pesanan::findWithDetails($pembayaran['pesanan_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Detail Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
</nav>

<div id="layoutSidenav">
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
                <h1 class="mt-4">Detail Pembayaran</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="list-pembayaran.php">Pembayaran</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-money-check-alt me-1"></i> Informasi Pembayaran</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Pembayaran</th>
                                <td><?= htmlspecialchars($pembayaran['id']) ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembayaran</th>
                                <td><?= htmlspecialchars($pembayaran['tanggal']) ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Bayar</th>
                                <td>Rp <?= number_format($pembayaran['jumlah_bayar'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th>ID Pesanan</th>
                                <td>#<?= htmlspecialchars($pembayaran['pesanan_id']) ?></td>
                            </tr>
                        </table>

                        <div class="mt-4">
                            <h5>Informasi Pesanan Terkait</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tanggal Pesanan</th>
                                    <td><?= htmlspecialchars($pesanan['tanggal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td><?= htmlspecialchars($pesanan['nama_pegawai']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td><?= htmlspecialchars($pesanan['jabatan']) ?></td>
                                </tr>
                                <tr>
                                    <th>Status Bayar</th>
                                    <td>
                                        <?= $pesanan['status_bayar'] ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-warning text-dark">Belum Lunas</span>' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td><?= htmlspecialchars($pesanan['diskon']) ?>%</td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="list-pembayaran.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a href="edit-pembayaran.php?id=<?= $pembayaran['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <a href="delete-pembayaran.php?id=<?= $pembayaran['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between small">
                    <div class="text-muted">&copy; Project 1 <?= date('Y') ?></div>
                    <div>
                        <a href="#">Privacy Policy</a> &middot;
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../public/js/scripts.js"></script>
</body>
</html>