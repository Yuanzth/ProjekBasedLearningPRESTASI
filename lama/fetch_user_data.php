<?php
session_start();
include 'includes/db_connect.php'; // Menghubungkan ke database

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_mhs.php");
    exit();
}

$username = $_SESSION['username'];
$userData = null;

// Memeriksa koneksi ke database
if ($conn) {
    // Query untuk mengambil data user
    $sql = "
        SELECT m.nama, m.program_studi
        FROM [user] u
        JOIN mahasiswa m ON u.id_user = m.id_user
        WHERE u.username = ?";

    // Menyiapkan statement
    $stmt = sqlsrv_prepare($conn, $sql, array(&$username));

    if ($stmt) {
        // Menjalankan statement
        sqlsrv_execute($stmt);
        
        // Mengambil hasil
        if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $userData = $row;
        } else {
            // Jika data user tidak ditemukan
            echo "Data user tidak ditemukan.";
        }

        // Menghentikan statement
        sqlsrv_free_stmt($stmt);
    } else {
        // Jika ada kesalahan dalam menyiapkan statement
        echo "Error in preparing statement: " . print_r(sqlsrv_errors(), true);
    }
} else {
    die("Koneksi ke database gagal.");
}
?>
