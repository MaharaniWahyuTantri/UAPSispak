<?php
$host = 'localhost';  // Ganti dengan host database Anda
$user = 'root';       // Ganti dengan username database Anda
$password = '';       // Ganti dengan password database Anda
$dbname = 'dbpakar';  // Ganti dengan nama database Anda

// Koneksi ke database menggunakan mysqli
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>
