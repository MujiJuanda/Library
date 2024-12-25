<?php
include '../../conf/koneksidbbuku.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';

$query = "SELECT id_member, nama FROM member";
if (!empty($q)) {
    $query .= " WHERE nama LIKE ?";
}

$stmt = $conn->prepare($query);
if (!empty($q)) {
    $searchTerm = '%' . $q . '%';
    $stmt->bind_param('s', $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id_member' => $row['id_member'],
        'nama' => $row['nama']
    ];
}

echo json_encode($data);
$stmt->close();
$conn->close();
?>
