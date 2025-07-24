<?php
require_once 'config/database.php';
include 'includes/header.php';

$query = "SELECT * FROM buku ORDER BY judul ASC";
$result = mysqli_query($conn, $query);
?>

<h2 class="mb-4">Daftar Buku</h2>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
        <a href="buku/create.php" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Jumlah Halaman</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['pengarang']); ?></td>
                            <td><?= htmlspecialchars($row['penerbit']); ?></td>
                            <td><?= $row['tahun_terbit']; ?></td>
                            <td><?= htmlspecialchars($row['jumlah_halaman']); ?></td>
                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                            <td>
                                <a href="buku/update.php?id=<?= $row['id_buku']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="buku/delete.php?id=<?= $row['id_buku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>