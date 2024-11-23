<?php
session_start();
include 'includes/db_connect.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa user
    $sql = "SELECT * FROM [user] WHERE username = ? AND password = ? AND privilege = 'M'";
    
    // Menyiapkan statement
    $stmt = sqlsrv_prepare($conn, $sql, array($username, $password));

    if ($stmt) {
        // Menjalankan statement
        sqlsrv_execute($stmt);
        
        // Mengambil hasil
        $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        if ($result) {
            // User ditemukan, set session
            $_SESSION['username'] = $username;
            header("Location: dashboard_mhs.php"); // Arahkan ke halaman dashboard
            exit();
        } else {
            // User tidak ditemukan
            echo "<script>alert('Username atau password salah!'); window.location.href='login_mhs.php';</script>";
        }
    } else {
        // Jika ada kesalahan dalam menyiapkan statement
        echo "Error in preparing statement: " . print_r(sqlsrv_errors(), true);
    }
}
?>