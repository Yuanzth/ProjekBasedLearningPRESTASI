<?php
include 'includes/db_connect.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kompetisi = $_POST['id_kompetisi'];
    $judul_kompetisi = $_POST['judul_kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
    $tempat_kompetisi = $_POST['tempat_kompetisi'];
    $tanggal_kompetisi = $_POST['tanggal_kompetisi'];
    $dosen = $_POST['dosen'];
    $role = $_POST['role'];

    // File upload logic
    $file_surat_tugas = null;
    $file_sertifikat = null;

    if (isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] === UPLOAD_ERR_OK) {
        $file_surat_tugas = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
    }

    if (isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] === UPLOAD_ERR_OK) {
        $file_sertifikat = file_get_contents($_FILES['file_sertifikat']['tmp_name']);
    }

    // Update query
    $sql = "UPDATE kompetisi SET 
            judul_kompetisi = ?, 
            tingkat_kompetisi = ?, 
            tempat_kompetisi = ?, 
            tanggal_kompetisi = ?, 
            id_dosen = ?, 
            role = ?, 
            file_surat_tugas = ?, 
            file_sertifikat = ? 
            WHERE id_kompetisi = ?";
    $params = array($judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, $tanggal_kompetisi, $dosen, $role, $file_surat_tugas, $file_sertifikat, $id_kompetisi);

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if (sqlsrv_execute($stmt)) {
        header("Location: tambah_kompetisi.php?update=success");
    } else {
        header("Location: edit_kompetisi.php?id=$id_kompetisi&update=fail");
    }
    exit;
}
?>
