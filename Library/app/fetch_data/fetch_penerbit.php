<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../conf/koneksidbbuku.php';

$query = "SELECT penerbit_id, penerbit_nama FROM penerbit";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'penerbit_id' => $row['penerbit_id'],
        'penerbit_nama' => $row['penerbit_nama']
    ];
}

echo json_encode($data);
mysqli_close($conn);
?>
