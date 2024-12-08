<?php
include_once 'konek.php';
include_once 'error_logger.php';
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    // Validasi session
    if (!isset($_SESSION['nim'])) {
        throw new Exception("Session NIM tidak ditemukan. Pastikan pengguna login.");
    }

    // Ambil data dari form
    $judul_kompetisi = $_POST['judul_kompetisi'] ?? null;
    $tingkat_kompetisi = $_POST['tingkat_kompetisi'] ?? null;
    $tempat_kompetisi = $_POST['tempat_kompetisi'] ?? null;
    $tanggal_kompetisi = $_POST['tanggal_kompetisi'] ?? null;
    $role = $_POST['role'] ?? null;
    $nip_dosen = $_POST['nip_dosen'] ?? null;
    $nim = $_SESSION['nim'];

    // Validasi input kosong
    if (!$judul_kompetisi || !$tingkat_kompetisi || !$tempat_kompetisi || !$tanggal_kompetisi || !$role || !$nip_dosen) {
        throw new Exception("Semua field harus diisi.");
    }

    // Validasi tanggal
    $tanggal_kompetisi = date("Y-m-d", strtotime($tanggal_kompetisi));
    if (!$tanggal_kompetisi) {
        throw new Exception("Format tanggal tidak valid.");
    }

    // Validasi file
    if (empty($_FILES['file_surat_tugas']['tmp_name']) || empty($_FILES['file_sertifikat']['tmp_name'])) {
        throw new Exception("File surat tugas atau sertifikat tidak ditemukan.");
    }

    // Baca file
    $file_surat_tugas = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
    $file_sertifikat = file_get_contents($_FILES['file_sertifikat']['tmp_name']);

    // Mulai transaksi
    sqlsrv_begin_transaction($conn);

    // Query insert
    $sql = "INSERT INTO kompetisi 
            (judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
             file_surat_tugas, file_sertifikat, role, nim, NIP, valid) 
            VALUES (?, ?, ?, ?, CONVERT(VARBINARY(MAX), ?), CONVERT(VARBINARY(MAX), ?), ?, ?, ?, 'N')";

    // Menyusun parameter untuk query
    $params = [
        $judul_kompetisi, 
        $tingkat_kompetisi, 
        $tempat_kompetisi, 
        $tanggal_kompetisi, 
        $file_surat_tugas, // Kirim file dalam bentuk string
        $file_sertifikat,  // Kirim file dalam bentuk string
        $role, 
        $nim, 
        $nip_dosen
    ];

    $stmt = sqlsrv_prepare($conn, $sql, $params);
    if ($stmt === false || !sqlsrv_execute($stmt)) {
        throw new Exception("Gagal menambahkan data kompetisi: " . print_r(sqlsrv_errors(), true));
    }

    // Commit transaksi
    sqlsrv_commit($conn);

    // Redirect dengan pesan sukses
    header("Location: mhs_pengajuan.php?success=1");
    exit();

} catch (Exception $e) {
    // Rollback jika terjadi error
    if (isset($conn)) {
        sqlsrv_rollback($conn);
    }

    // Log error
    logError($e->getMessage());

    // Redirect dengan pesan error
    header("Location: mhs_pengajuan.php?error=" . urlencode($e->getMessage()));
    exit();

} finally {
    // Cleanup resource
    if (isset($stmt)) {
        sqlsrv_free_stmt($stmt);
    }
    if (isset($conn)) {
        sqlsrv_close($conn);
    }
}
?>
