<?php
session_start();
include 'includes/db_connect.php'; // Menghubungkan ke database

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$adminData = null;

// Memeriksa koneksi ke database
if ($conn) {
    // Query untuk mengambil data admin berdasarkan admin_id
    $sql = "
        SELECT a.id_admin, a.nama, u.username
        FROM admin a
        JOIN [user] u ON a.id_user = u.id_user
        WHERE a.id_admin = ?";

    // Menyiapkan statement
    $stmt = sqlsrv_prepare($conn, $sql, array(&$admin_id));

    if ($stmt) {
        // Menjalankan statement
        sqlsrv_execute($stmt);
        
        // Mengambil hasil
        if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $adminData = $row;
        } else {
            // Jika data admin tidak ditemukan
            echo "Data admin tidak ditemukan.";
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
