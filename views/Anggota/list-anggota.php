<?php
session_start();

require_once __DIR__ . '/../../models/Anggota.php';

use models\Anggota;

$anggota = Anggota::getWithDetails();

include __DIR__ . '/../template/header.php';
include __DIR__ . '/../template/sidebar.php';
?>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Anggota</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> List Anggota
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="create-anggota.php" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Anggota
                                </a>
                            </div>
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Kartu Diskon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($anggota as $index => $item): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $item['nip'] ?></td>
                                            <td><?= $item['nama_pegawai'] ?></td>
                                            <td><?= $item['status_aktif'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                            <td><?= $item['nama_diskon'] ?? 'Tidak Ada' ?></td>
                                            <td>
                                                <a href="detail-anggota.php?id=<?= $item['anggota_id'] ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="edit-anggota.php?id=<?= $item['anggota_id'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete-anggota.php?id=<?= $item['anggota_id'] ?>" 
                                                    class="btn btn-danger btn-sm delete-btn"
                                                    data-id="<?= $item['anggota_id'] ?>"
                                                    data-nama="<?= $item['nama_pegawai'] ?>">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Project 1 <?= date('Y') ?></div>
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
            const nama = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                text: `Data anggota atas nama ${nama} akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete-anggota.php?id=${id}`;
                }
            });
        });
    });
    </script>

</body>
</html>