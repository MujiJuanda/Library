<?php
// fetch_buku.php
include '../../conf/koneksidbbuku.php'; // Make sure to include database connection details

$query = "SELECT id_member, nama, tgl_pinjam, tgl_kembali, buku_judul, buku_ISBN, jumlah FROM pinjam";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
