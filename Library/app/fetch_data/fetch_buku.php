<?php
// fetch_buku.php
include '../../conf/koneksidbbuku.php'; // Make sure to include database connection details

$query = "SELECT buku_ISBN AS id_buku, buku_judul AS nama_buku, penerbit_id AS nama_penerbit, buku_tglterbit, buku_jmlhalaman, buku_deskripsi, buku_harga FROM buku";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
