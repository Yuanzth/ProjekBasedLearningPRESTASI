<?php
include 'includes/db_connect.php'; // Koneksi ke database
session_start(); // Mulai sesi untuk ambil data mahasiswa login

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi session
    if (!isset($_SESSION['nim'])) {
        die("Session NIM tidak ditemukan. Pastikan pengguna login.");
    }

    // Ambil data dari form
    $judul_kompetisi = $_POST['judul_kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
    $tempat_kompetisi = $_POST['tempat_kompetisi'];
    $tanggal_kompetisi = date("Y-m-d", strtotime($_POST['tanggal_kompetisi']));
    $role = $_POST['role'];
    $nim = $_SESSION['nim']; // Ambil NIM dari sesi mahasiswa login

    // Pastikan file diupload
    if (isset($_FILES['file_surat_tugas']) && isset($_FILES['file_sertifikat'])) {
        // Membaca konten file dan mengubahnya menjadi format VARBINARY
        $file_surat_tugas = file_get_contents($_FILES['file_surat_tugas']['tmp_name']);
        $file_sertifikat = file_get_contents($_FILES['file_sertifikat']['tmp_name']);
    } else {
        die("File surat tugas atau sertifikat tidak ditemukan.");
    }

    // Query untuk insert data ke tabel kompetisi (sebelum validasi admin)
    $sql = "INSERT INTO kompetisi 
            (judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
             file_surat_tugas, file_sertifikat, role, nim) 
            VALUES (?, ?, ?, ?, CONVERT(VARBINARY(MAX), ?), CONVERT(VARBINARY(MAX), ?), ?, ?)";

    $params = array(
        $judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, $tanggal_kompetisi,
        $file_surat_tugas, $file_sertifikat, $role, $nim
    );

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        // Ambil nilai kompetisi_counter yang baru saja dimasukkan
        $last_id_query = "SELECT SCOPE_IDENTITY() AS last_id";
        $last_id_result = sqlsrv_query($conn, $last_id_query);
        $last_id_row = sqlsrv_fetch_array($last_id_result);
        $kompetisi_counter = $last_id_row['last_id'];

        // Membuat ID dengan format Kxxx (misalnya K001)
        $id_kompetisi = 'K' . str_pad($kompetisi_counter, 3, '0', STR_PAD_LEFT);

        // Update id_kompetisi dengan format yang sesuai
        $update_sql = "UPDATE kompetisi SET id_kompetisi = ? WHERE kompetisi_counter = ?";
        $update_params = array($id_kompetisi, $kompetisi_counter);
        $update_stmt = sqlsrv_prepare($conn, $update_sql, $update_params);

        if (sqlsrv_execute($update_stmt)) {
            header("Location: tambah_kompetisi.php?success=1");
        } else {
            // Debugging error
            $errors = sqlsrv_errors();
            print_r($errors);
            die();
            header("Location: tambah_kompetisi.php?error=1");
        }
    } else {
        // Debugging error
        $errors = sqlsrv_errors();
        print_r($errors);
        die();
        header("Location: tambah_kompetisi.php?error=1");
    }
}
?>
