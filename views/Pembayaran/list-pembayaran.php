<?php
session_start();
require_once __DIR__ . '/../../models/Pembayaran.php';
require_once __DIR__ . '/../../models/Pesanan.php';
use models\Pembayaran;

$pembayaran = Pembayaran::getAllWithDetails();
$pageTitle = 'List Pembayaran';

include __DIR__ . '/../template/header.php';
include __DIR__ . '/../template/sidebar.php';
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembayaran</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> List Pembayaran
            </div>
            <div class="card-body">
                <div class="mb-3 text-end">
                    <a href="create-pembayaran.php" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Pembayaran
                    </a>
                </div>
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pembayaran) === 0): ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data pembayaran.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pembayaran as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($item['tanggal']) ?></td>
                                    <td><?= htmlspecialchars($item['nama_anggota']) ?></td>
                                    <td>Rp<?= number_format($item['jumlah_bayar'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="edit-pembayaran.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit
                                        </a>
                                        <a href="detail-pembayaran.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">Detail
                                        </a>
                                        <a href="delete-pembayaran.php?id=<?= $item['id'] ?>"
                                           class="btn btn-danger btn-sm delete-btn"
                                           data-id="<?= $item['id'] ?>"
                                           data-item="Pembayaran atas nama <?= htmlspecialchars($item['nama_anggota']) ?>">
                                           <i class="fas fa-trash"></i> Delete
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

<?php include __DIR__ . '/../template/footer.php'; ?>

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
                window.location.href = `delete-pembayaran.php?id=${id}`;
            }
        });
    });
});
</script>
</body>
</html>
