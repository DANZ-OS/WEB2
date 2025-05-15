<?php
session_start();

require_once __DIR__ . '/../../models/Pegawai.php';

use models\Pegawai;

$pegawai = Pegawai::get();

include __DIR__ . '/../template/header.php';
include __DIR__ . '/../template/sidebar.php';
?>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pegawai</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pegawai</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> List Pegawai
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-end">
                                <a href="create-pegawai.php" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Pegawai
                                </a>
                            </div>
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pegawai as $index => $user): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $user['nip'] ?></td>
                                            <td><?= $user['nama'] ?></td>
                                            <td><?= $user['jenis_kelamin'] ?></td>
                                            <td><?= $user['jabatan'] ?></td>
                                            <td>
                                                <a href="detail-pegawai.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="edit-pegawai.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete-pegawai.php?id=<?= $user['id'] ?>" 
                                                    class="btn btn-danger btn-sm delete-btn"
                                                    data-id="<?= $user['id'] ?>"
                                                    data-nama="<?= $user['nama'] ?>">
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
                text: `Data atas nama ${nama} akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete-pegawai.php?id=${id}`;
                }
            });
        });
    });
    </script>

</body>
</html>
