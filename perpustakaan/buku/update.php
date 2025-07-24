<?php
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM buku WHERE id_buku = $id";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

if (!$buku) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = intval($_POST['tahun_terbit']);
    $jumlah_halaman = intval($_POST['jumlah_halaman']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);



    $query = "UPDATE buku SET 
              judul = '$judul', 
              pengarang = '$pengarang', 
              penerbit = '$penerbit', 
              tahun_terbit = $tahun_terbit, 
              jumlah_halaman = $jumlah_halaman, 
              kategori = '$kategori'
              WHERE id_buku = $id";

    if (mysqli_query($conn, $query)) {
        session_start();
        $_SESSION['success'] = "Data buku berhasil diperbarui!";
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

include '../includes/header.php';
?>

<h2 class="mb-4">Edit Data Buku</h2>

<div class="card shadow">
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900" max="<?= date('Y'); ?>" value="<?= $buku['tahun_terbit']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" min="1" value="<?= $buku['jumlah_halaman']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= htmlspecialchars($buku['kategori']); ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>