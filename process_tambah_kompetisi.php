<?php
include 'includes/db_connect.php';
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validasi session
        if (!isset($_SESSION['nim'])) {
            throw new Exception("Session NIM tidak ditemukan. Pastikan pengguna login.");
        }

        // Ambil data dari form
        $judul_kompetisi = $_POST['judul_kompetisi'];
        $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
        $tempat_kompetisi = $_POST['tempat_kompetisi'];
        $tanggal_kompetisi = date("Y-m-d", strtotime($_POST['tanggal_kompetisi']));
        $role = $_POST['role'];
        $nim = $_SESSION['nim'];
        $nip_dosen = $_POST['nip_dosen'];

        // Validasi file
        if (!isset($_FILES['file_surat_tugas']) || !isset($_FILES['file_sertifikat'])) {
            throw new Exception("File surat tugas atau sertifikat tidak ditemukan.");
        }

        // Baca file
        $file_surat_tugas = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
        $file_sertifikat = file_get_contents($_FILES['file_sertifikat']['tmp_name']);

        // Mulai transaction
        sqlsrv_begin_transaction($conn);

        // Query insert dengan NIP dosen
        $sql = "INSERT INTO kompetisi 
                (judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
                 file_surat_tugas, file_sertifikat, role, nim, NIP, valid) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'N')";

        $params = array(
            $judul_kompetisi, 
            $tingkat_kompetisi, 
            $tempat_kompetisi, 
            $tanggal_kompetisi,
            $file_surat_tugas, 
            $file_sertifikat, 
            $role, 
            $nim,
            $nip_dosen
        );

        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if ($stmt === false || !sqlsrv_execute($stmt)) {
            throw new Exception("Error inserting data: " . print_r(sqlsrv_errors(), true));
        }

        // Commit transaction
        sqlsrv_commit($conn);
        
        header("Location: tambah_kompetisi.php?success=1");
        exit();

    } else {
        throw new Exception("Invalid request method");
    }

} catch (Exception $e) {
    // Rollback jika ada error
    if (sqlsrv_begin_transaction($conn)) {
        sqlsrv_rollback($conn);
    }
    
    error_log("Error in process_tambah_kompetisi.php: " . $e->getMessage());
    header("Location: tambah_kompetisi.php?error=1");
    exit();

} finally {
    // Cleanup
    if (isset($stmt)) {
        sqlsrv_free_stmt($stmt);
    }
    if (isset($conn)) {
        sqlsrv_close($conn);
    }
}
?>