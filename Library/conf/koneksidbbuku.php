<?php
// Informasi koneksi ke database
$host = 'localhost';         // Biasanya 'localhost'
$user = 'root';        // Username database
$password = '';          // Password database
$database = 'dbbuku';        // Nama database

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $password, $database);

// Cek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
