<?php
require_once __DIR__ . '/../../models/Produk.php';
require_once __DIR__ . '/../../models/JenisProduk.php';

use models\Produk;
use models\JenisProduk;

if (!isset($_GET['id'])) {
    header("Location: list-produk.php");
    exit;
}

$produk = Produk::find($_GET['id']);
$jenis_produk_list = JenisProduk::getall();

if (!$produk) {
    header("Location: list-produk.php");
    exit;
}

if (isset($_POST['submit'])) {
    $data = [
        'id' => $_GET['id'],
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'jenis_produk_id' => $_POST['jenis_produk_id'],
    ];

    Produk::update($data);
    header("Location: list-produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Koperasi - Edit Produk</title>
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
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
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
                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Produk
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
                    <h1 class="mt-4">Edit Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-produk.php">Produk</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-box me-1"></i>
                            Edit Produk
                        </div>
                        <div class="card-body">
                            <form action="edit-produk.php?id=<?= $produk['id'] ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk['nama'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $produk['harga'] ?>" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="<?= $produk['stok'] ?>" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_jenis_produk" class="form-label">Jenis Produk</label>
                                    <select class="form-select" id="jenis_produk_id" name="jenis_produk_id" required>
                                        <option value="">-- Pilih Jenis Produk --</option>
                                        <?php foreach ($jenis_produk_list as $jenis): ?>
                                            <option value="<?= $jenis['id'] ?>" <?= $produk['jenis_produk_id'] == $jenis['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($jenis['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <a href="list-produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Project 1 <?= date('Y') ?></div>
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
    <script src="../../public/js/scripts.js"></script>
</body>
</html>
