<?php
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/Anggota.php';
require_once __DIR__ . '/../../models/Produk.php';

use models\Pesanan;
use models\Anggota;
use models\Produk;

$anggotaList = Anggota::getWithDetails();
$produkList = Produk::getWithJenis();

if (isset($_POST['submit'])) {
    $data = [
        'tanggal' => $_POST['tanggal'],
        'diskon' => $_POST['diskon'],
        'status_bayar' => isset($_POST['status_bayar']) ? 1 : 0,
        'anggota_id' => $_POST['anggota_id'],
    ];

    $pesananId = Pesanan::create($data);

    if ($pesananId && isset($_POST['produk_id'])) {
        $pdo = \config\Connection::make();
        $stmt = $pdo->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (?, ?, ?)");

        foreach ($_POST['produk_id'] as $index => $produkId) {
            $jumlah = $_POST['jumlah'][$index];
            $stmt->execute([$pesananId, $produkId, $jumlah]);
        }
    }

    header("Location: list-pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tambah Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." />
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="list-pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
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

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Pesanan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-pesanan.php">Pesanan</a></li>
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Form Pesanan
                        </div>
                        <div class="card-body">
                            <form action="create-pesanan.php" method="POST">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <label for="diskon" class="form-label">Diskon (%)</label>
                                    <input type="number" class="form-control" name="diskon" id="diskon" value="0" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="anggota_id" class="form-label">Anggota</label>
                                    <select class="form-select" name="anggota_id" required>
                                        <option value="" hidden>-- Pilih Anggota --</option>
                                        <?php foreach ($anggotaList as $anggota): ?>
                                            <option value="<?= $anggota['anggota_id'] ?>"><?= $anggota['nama_pegawai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="status_bayar" id="status_bayar">
                                    <label class="form-check-label" for="status_bayar">Sudah Dibayar</label>
                                </div>

                                <hr>
                                <h5>Detail Produk</h5>
                                <div id="produk-container">
                                    <div class="row mb-2 produk-item">
                                        <div class="col-md-6">
                                            <select name="produk_id[]" class="form-select" required>
                                                <option value="" hidden>-- Pilih Produk --</option>
                                                <?php foreach ($produkList as $produk): ?>
                                                    <option value="<?= $produk['id'] ?>"><?= $produk['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" min="1" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                                <a href="list-pesanan.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        document.getElementById('add-produk').addEventListener('click', function () {
            const container = document.getElementById('produk-container');
            const firstItem = container.querySelector('.produk-item');
            const clone = firstItem.cloneNode(true);
            clone.querySelectorAll('input, select').forEach(el => el.value = '');
            container.appendChild(clone);
        });

        document.getElementById('produk-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                const items = document.querySelectorAll('.produk-item');
                if (items.length > 1) {
                    e.target.closest('.produk-item').remove();
                }
            }
        });
    </script>
</body>
</html>
