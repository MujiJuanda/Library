<?php
// fetch_buku.php
include '../../conf/koneksidbbuku.php'; // Make sure to include database connection details

$query = "SELECT kategori_id AS id_kategori, kategori_nama AS kategori FROM kategori";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
