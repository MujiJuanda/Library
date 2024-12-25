<?php
// Memulai sesi untuk menggunakan session pada login
session_start();

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Menghubungkan ke database
include 'koneksidbbuku.php';

// Cek apakah request datang dari form dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escape input untuk mencegah SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk cek apakah username dan password cocok di database
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Jika query berhasil dan ada hasil yang cocok
    if ($result && mysqli_num_rows($result) > 0) {
        // Menyimpan username di session dan mengarahkan ke halaman dashboard
        $_SESSION['username'] = $username;
        header("Location: ../app");
        exit(); // Menghentikan eksekusi setelah redirect
    } else {
        // Jika login gagal, tampilkan pesan error
        echo "Username atau password salah.";
    }
}
?>
