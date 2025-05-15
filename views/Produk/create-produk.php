<?php
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../models/JenisProduk.php';

use models\Produk;
use models\JenisProduk;

$jenisProduks = JenisProduk::getAll();

if (isset($_POST['submit'])) {
    $data = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'deskripsi' => $_POST['deskripsi'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'jenis_produk_id' => $_POST['jenis_produk_id'],
    ];

    Produk::create($data);
    header("Location: list-produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <!-- Top navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search..." />
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" data-bs-toggle="dropdown"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>
                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="../pegawai/list-pegawai.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Pegawai
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Zaidaan A Dzihnie
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-produk.php">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-box me-1"></i> Form Produk</div>
                        <div class="card-body">
                            <form action="create-produk.php" method="POST">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Produk</label>
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                                    <select class="form-select" id="jenis_produk_id" name="jenis_produk_id" required>
                                        <option value="">-- Pilih Jenis Produk --</option>
                                        <?php foreach ($jenisProduks as $jenis): ?>
                                            <option value="<?= $jenis['id'] ?>"><?= htmlspecialchars($jenis['nama']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <a href="JenisProduk/create-jenisproduk.php" class="btn btn-outline-success">
                                        <i class="fas fa-plus"></i> Tambah Jenis
                                    </a>
                                </div>

                                <a href="list-produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between small">
                        <div class="text-muted">&copy; Project 1 <?= date('Y') ?></div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot; <a href="#">Terms & Conditions</a>
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
