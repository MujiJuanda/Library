<?php
include '../../conf/koneksidbbuku.php'; // Pastikan koneksi berhasil

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    // Menambahkan data member baru
    $id_member = $_POST['id_member'] ?? '';
    $nama = $_POST['nama'] ?? '';

    // Cek apakah member sudah ada berdasarkan nama
    $checkQuery = "SELECT * FROM member WHERE nama = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "s", $nama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(["status" => "error", "message" => "member sudah ada"]);
    } else {
        // Menambahkan member baru
        $query = "INSERT INTO member (id_member, nama) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $id_member, $nama); // Perbaiki parameter

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Data member berhasil ditambahkan"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
        }
    }

} elseif ($action === 'update') {
    // Update data member
    $id_member = $_POST['id_member'] ?? '';
    $nama = $_POST['nama'] ?? '';

    if (!empty($id_member)) {
        // Lakukan update data member
        $query = "UPDATE member SET nama=? WHERE id_member=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $nama, $id_member); // Perbaiki binding parameter

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Data member berhasil diperbarui"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ID member tidak ditemukan"]);
    }

} elseif ($action === 'delete') {
    // Hapus data member
    $id_member = $_POST['id_member'] ?? '';

    if ($id_member) {
        // Hapus data member
        $query = "DELETE FROM member WHERE id_member=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $id_member);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Data member berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ID member tidak valid"]);
    }

} elseif ($action === 'read') {
    // Menampilkan data member
    $query = "SELECT id_member, nama FROM member";
    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id_member' => $row['id_member'],
            'nama' => $row['nama']
        ];
    }

    echo json_encode($data);
}

mysqli_close($conn);
?>
