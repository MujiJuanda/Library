<?php
include '../../conf/koneksidbbuku.php'; // Pastikan file koneksi database ada dan terhubung

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    // Tambah data (cek apakah id_buku sudah ada)
    $penerbit_id = $_POST['penerbit_id'] ?? '';
    $penerbit_nama = $_POST['penerbit_nama'] ?? '';

    // Cek apakah buku sudah ada
    $checkQuery = "SELECT * FROM penerbit WHERE penerbit_id = '$penerbit_id'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "Penerbit ID sudah ada, lakukan update";
    } else {
        $query = "INSERT INTO penerbit (penerbit_id, penerbit_nama)
                  VALUES ('$penerbit_id', '$penerbit_nama')";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif ($action === 'update') {
    // Update data
    $penerbit_id = $_POST['penerbit_id'] ?? '';
    $penerbit_nama= $_POST['penerbit_nama'] ?? '';

    // Periksa jika id_buku ada
    if (!empty($penerbit_id)) {
        // Lakukan update query
        $query = "UPDATE penerbit SET 
                  penerbit_id='$penerbit_id', 
                  penerbit_nama='$penerbit_nama', 
                  WHERE penerbit_id='$penerbit_id'";
        
        // Debug log query
        echo $query; // Debug output query yang dijalankan

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil diperbarui";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Penerbit ID tidak ditemukan";
    }
} elseif ($action === 'delete') {
    // Hapus data
    $penerbit_id = $_POST['penerbit_id'] ?? 0;
    $query = "DELETE FROM penerbit WHERE penerbit_id='$penerbit_id'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
