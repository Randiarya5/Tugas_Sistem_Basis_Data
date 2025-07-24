<!-- FUNGSINYA UNTUK MANGGIL DATABASE DAN HARUS SESUAI DENGAN NAMA DATABASE DI PHPMYADMIN -->

<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>