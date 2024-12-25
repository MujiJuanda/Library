<?php
// Pastikan untuk menyertakan file koneksi database
include '../../conf/koneksidbbuku.php';

// Ambil parameter pencarian jika ada
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Query dasar untuk mengambil data dari tabel buku
$query = "SELECT 
            buku_ISBN AS id_buku, 
            buku_judul AS nama_buku, 
            nama_penerbit AS nama_penerbit, 
            buku_tglterbit AS buku_tglterbit, 
            buku_jmlhalaman AS buku_jmlhalaman, 
            buku_deskripsi AS buku_deskripsi, 
            buku_harga AS buku_harga 
          FROM buku AS b
          LEFT JOIN penerbit AS penerbit_id = penerbit_id";

// Tambahkan kondisi pencarian jika parameter q tersedia
if (!empty($q)) {
    $query .= " WHERE buku_judul LIKE ?";
}

// Persiapkan statement untuk eksekusi
$stmt = $conn->prepare($query);

// Bind parameter pencarian jika tersedia
if (!empty($q)) {
    $searchTerm = '%' . $q . '%';
    $stmt->bind_param('s', $searchTerm);
}

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();

// Menyimpan data hasil query
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id_buku' => $row['id_buku'],
        'nama_buku' => $row['nama_buku'],
        'nama_penerbit' => $row['nama_penerbit'],
        'buku_tglterbit' => $row['buku_tglterbit'],
        'buku_jmlhalaman' => $row['buku_jmlhalaman'],
        'buku_deskripsi' => $row['buku_deskripsi'],
        'buku_harga' => $row['buku_harga']
    ];
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
