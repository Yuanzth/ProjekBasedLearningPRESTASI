<?php
include 'includes/db_connect.php'; // Koneksi database

if (!isset($_GET['id']) || !isset($_GET['file'])) {
    die("Parameter tidak lengkap.");
}

$id_kompetisi = $_GET['id'];
$file_type = $_GET['file']; // surat_tugas atau sertifikat

// Query untuk mengambil file berdasarkan id kompetisi
$sql = "SELECT file_surat_tugas, file_sertifikat FROM kompetisi WHERE id_kompetisi = ?";
$params = array($id_kompetisi);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$data) {
    die("Data kompetisi tidak ditemukan.");
}

// Menentukan file yang akan di-preview
$file_data = null;
$file_name = null;

if ($file_type === 'surat_tugas') {
    $file_data = $data['file_surat_tugas'];
    $file_name = "surat_tugas_$id_kompetisi";
} elseif ($file_type === 'sertifikat') {
    $file_data = $data['file_sertifikat'];
    $file_name = "sertifikat_$id_kompetisi";
}

if ($file_data === null) {
    die("File tidak ditemukan.");
}

// Header untuk pratinjau file
header("Content-Disposition: inline; filename=$file_name");
header("Content-Type: application/pdf"); // Default ke PDF
echo $file_data;
exit;
?>
