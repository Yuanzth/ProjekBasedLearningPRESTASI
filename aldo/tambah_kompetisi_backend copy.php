<?php
include 'konek.php'; // Koneksi ke database

// Cek apakah session NIM ada
if (!isset($_SESSION['nim'])) {
    header("Location: login.html");
    exit();
}

$nim_mahasiswa = $_SESSION['nim'];

// Query untuk data kompetisi yang belum divalidasi sesuai NIM mahasiswa
$sql = "SELECT * FROM kompetisi WHERE valid='N' AND nim = ?";
$params = array($nim_mahasiswa);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$kompetisi_data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $kompetisi_data[] = $row;
}

// Jika ingin digunakan secara global (misalnya melalui include)
return $kompetisi_data;

?>
