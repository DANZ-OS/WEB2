<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= $pageTitle ?? 'Koperasi' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../public/css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php if (isset($_SESSION['alert'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['alert']['type'] ?>',
                title: '<?= $_SESSION['alert']['message'] ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../dashboard.php">Project 1</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="layoutSidenav">
