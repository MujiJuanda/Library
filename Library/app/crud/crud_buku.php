<?php
include '../../conf/koneksidbbuku.php'; // Pastikan file koneksi database ada dan terhubung

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    // Tambah data (cek apakah id_buku sudah ada)
    $id_buku = $_POST['id_buku'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tgl_terbit = $_POST['tgl_terbit'] ?? '';
    $jml_halaman = $_POST['jml_halaman'] ?? 0;
    $harga = $_POST['harga'] ?? 0.0;

    // Cek apakah buku sudah ada
    $checkQuery = "SELECT * FROM buku WHERE buku_ISBN = '$id_buku'";
    $result = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "ID Buku sudah ada, lakukan update";
    } else {
        $query = "INSERT INTO buku (buku_ISBN, buku_judul, penerbit_id, buku_tglterbit, buku_jmlhalaman, buku_harga)
                  VALUES ('$id_buku', '$judul', '$penerbit', '$tgl_terbit', $jml_halaman, $harga)";
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif ($action === 'update') {
    // Update data
    $id_buku = $_POST['id_buku'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tgl_terbit = $_POST['tgl_terbit'] ?? '';
    $jml_halaman = $_POST['jml_halaman'] ?? 0;
    $harga = $_POST['harga'] ?? 0.0;

    // Periksa jika id_buku ada
    if (!empty($id_buku)) {
        // Lakukan update query
        $query = "UPDATE buku SET 
                  buku_judul='$judul', 
                  penerbit_id='$penerbit', 
                  buku_tglterbit='$tgl_terbit', 
                  buku_jmlhalaman=$jml_halaman, 
                  buku_harga=$harga
                  WHERE buku_ISBN='$id_buku'";
        
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
    $query = "DELETE FROM buku WHERE buku_ISBN='$id_buku'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
