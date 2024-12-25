<?php
include '../../conf/koneksidbbuku.php'; // Pastikan file koneksi database ada dan terhubung

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    // Tambah data
    $pengarang_id = $_POST['pengarang_id'] ?? '';
    $pengarang_nama = $_POST['pengarang_nama'] ?? '';
    $email = $_POST['email'] ?? '';

    // Cek apakah pengarang_id sudah ada
    $checkQuery = "SELECT * FROM pengarang WHERE pengarang_id = '$pengarang_id'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "ID pengarang sudah ada, apakah Anda mau update?";
    } else {
        $query = "INSERT INTO pengarang (pengarang_id, pengarang_nama, email) 
                  VALUES ('$pengarang_id', '$pengarang_nama', '$email')";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif ($action === 'update') {
    // Update data
    $pengarang_id = $_POST['pengarang_id'] ?? '';
    $pengarang_nama = $_POST['pengarang_nama'] ?? '';
    $email = $_POST['email'] ?? '';

    // Periksa jika pengarang_id ada
    if (!empty($pengarang_id)) {
        // Lakukan update query
        $query = "UPDATE pengarang SET 
                  pengarang_nama='$pengarang_nama', 
                  email='$email'
                  WHERE pengarang_id='$pengarang_id'";
        
        // Debug log query
        error_log("Query Update: " . $query); // Debug output query yang dijalankan

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil diperbarui";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "ID pengarang tidak ditemukan";
    }
} elseif ($action === 'delete') {
    // Hapus data
    $pengarang_id = $_POST['pengarang_id'] ?? 0;
    if ($pengarang_id > 0) {
        $query = "DELETE FROM pengarang WHERE pengarang_id='$pengarang_id'";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil dihapus";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "ID pengarang tidak valid";
    }
}

// Tutup koneksi database
mysqli_close($conn);
?>
