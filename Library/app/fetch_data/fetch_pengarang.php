<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Tambahkan header ini

include '../../conf/koneksidbbuku.php';

$query = "SELECT pengarang_id, pengarang_nama, email FROM pengarang";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'pengarang_id' => $row['pengarang_id'],
        'pengarang_nama' => $row['pengarang_nama'],
        'email' => $row['email']
    ];
}

echo json_encode($data);
mysqli_close($conn);
?>
