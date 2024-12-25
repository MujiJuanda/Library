<?php
include '../../conf/koneksidbbuku.php'; // Pastikan file koneksi database ada dan terhubung

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    // Tambah data (cek apakah id_buku sudah ada)
    $id_kategori = $_POST['id_kategori'] ?? '';
    $kategori = $_POST['kategori'] ?? '';

    // Cek apakah buku sudah ada
    $checkQuery = "SELECT * FROM kategori WHERE kategori_id = '$id_kategori'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "ID Kategori sudah ada, lakukan update";
    } else {
        $query = "INSERT INTO kategori (kategori_id, kategori_nama)
                  VALUES ('$id_kategori', '$kategori')";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif ($action === 'update') {
    // Update data
    $id_kategori = $_POST['id_kategori'] ?? '';
    $kategori = $_POST['kategori'] ?? '';

    // Periksa jika id_buku ada
    if (!empty($id_kategori)) {
        // Lakukan update query
        $query = "UPDATE kategori SET 
                  kategori_nama='$kategori', 
                  WHERE kategori_id='$id_kategori'";
        
        // Debug log query
        echo $query; // Debug output query yang dijalankan

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil diperbarui";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "ID Buku tidak ditemukan";
    }
} elseif ($action === 'delete') {
    // Hapus data
    $id_buku = $_POST['id_buku'] ?? 0;
    $query = "DELETE FROM kategori WHERE kategori_id='$id_kategori'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
