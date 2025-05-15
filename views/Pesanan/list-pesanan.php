<?php
session_start();
require_once __DIR__ . '/../../models/Pesanan.php';
require_once __DIR__ . '/../../models/Anggota.php';
use models\Pesanan;

$pesanan = Pesanan::getAll();
$pageTitle = 'List Pesanan';

include __DIR__ . '/../template/header.php';
include __DIR__ . '/../template/sidebar.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> List Pesanan
            </div>
            <div class="card-body">
                <div class="mb-3 text-end">
                    <a href="create-pesanan.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Pesanan
                    </a>
                </div>
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pesanan</th>
                            <th>Nama Anggota</th>
                            <th>Diskon (%)</th>
                            <th>Status Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pesanan) === 0): ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pesanan as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($item['tanggal']) ?></td>
                                    <td><?= htmlspecialchars($item['nama_pegawai']) ?></td>
                                    <td><?= $item['diskon'] ?>%</td>
                                    <td>
                                        <?= $item['status_bayar'] ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-warning text-dark">Belum Lunas</span>' ?>
                                    </td>
                                    <td>
                                        <a href="detail-pesanan.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="edit-pesanan.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete-pesanan.php?id=<?= $item['id'] ?>" 
                                           class="btn btn-danger btn-sm delete-btn"
                                           data-id="<?= $item['id'] ?>"
                                           data-item="Pesanan atas nama <?= htmlspecialchars($item['nama_pegawai']) ?>">
                                           <i class="fas fa-trash"></i> delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; DANZ COMPANY <?= date('Y') ?></div>
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="../../public/js/datatables-simple-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        const item = this.getAttribute('data-item');

        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            text: `${item} akan dihapus permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `delete-pesanan.php?id=${id}`;
            }
        });
    });
});
</script>

</body>
</html>
