<?php
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = intval($_GET['id']);

// Get book data to delete cover file
$query = "SELECT * FROM buku WHERE id_buku = $id";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

// Delete the book
$query = "DELETE FROM buku WHERE id_buku = $id";
if (mysqli_query($conn, $query)) {
    // Delete cover file if not default
    if ($buku['cover'] !== 'default-cover.jpg') {
        unlink("../../assets/images/" . $buku['cover']);
    }

    session_start();
    $_SESSION['success'] = "Buku berhasil dihapus!";
} else {
    session_start();
    $_SESSION['error'] = "Error: " . mysqli_error($conn);
}

header("Location: ../index.php");
exit();
