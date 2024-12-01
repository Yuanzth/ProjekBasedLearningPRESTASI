<?php
include 'includes/db_connect.php'; // Koneksi database

// Pastikan koneksi ke database berhasil
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_kompetisi = $_POST['id_kompetisi'];
    $judul_kompetisi = $_POST['judul_kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
    $tempat_kompetisi = $_POST['tempat_kompetisi'];
    $tanggal_kompetisi = $_POST['tanggal_kompetisi'];
    $dosen = $_POST['NIP'];
    $role = $_POST['role'];

    // Ambil file lama dari database jika ada
    $file_surat_tugas = null;
    $file_sertifikat = null;

    // Query untuk mengambil file lama berdasarkan id_kompetisi
    $sql_select = "SELECT file_surat_tugas, file_sertifikat FROM kompetisi WHERE id_kompetisi = ?";
    $stmt_select = sqlsrv_prepare($conn, $sql_select, array($id_kompetisi));

    if (sqlsrv_execute($stmt_select)) {
        $row = sqlsrv_fetch_array($stmt_select, SQLSRV_FETCH_ASSOC);
        if ($row) {
            // Jika ada file lama, simpan untuk digunakan nanti
            $file_surat_tugas = $row['file_surat_tugas'];
            $file_sertifikat = $row['file_sertifikat'];
        }
    } else {
        die(print_r(sqlsrv_errors(), true)); // Jika gagal mengambil data lama
    }

    // Proses upload file surat tugas jika ada
    if (isset($_FILES['file_surat_tugas']) && $_FILES['file_surat_tugas']['error'] === UPLOAD_ERR_OK) {
        $file_surat_tugas = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
    }

    // Proses upload file sertifikat jika ada
    if (isset($_FILES['file_sertifikat']) && $_FILES['file_sertifikat']['error'] === UPLOAD_ERR_OK) {
        $file_sertifikat = file_get_contents($_FILES['file_sertifikat']['tmp_name']);
    }

    // Menyiapkan query UPDATE
    $sql = "UPDATE kompetisi SET 
            judul_kompetisi = ?, 
            tingkat_kompetisi = ?, 
            tempat_kompetisi = ?, 
            tanggal_kompetisi = ?, 
            NIP = ?, 
            role = ?, 
            file_surat_tugas = CONVERT(VARBINARY(MAX), ?), 
            file_sertifikat = CONVERT(VARBINARY(MAX), ?) 
            WHERE id_kompetisi = ?";

    // Menyusun parameter untuk query
    $params = array($judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, $tanggal_kompetisi, $dosen, $role, $file_surat_tugas, $file_sertifikat, $id_kompetisi);

    // Menyiapkan dan mengeksekusi query
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Menampilkan error jika query gagal dipersiapkan
    }

    // Menjalankan query
    if (sqlsrv_execute($stmt)) {
        // Redirect jika update sukses
        header("Location: tambah_kompetisi.php?update=success");
    } else {
        // Redirect jika update gagal
        die('Error during execution: ' . print_r(sqlsrv_errors(), true));
    }

    exit;
}
?>
