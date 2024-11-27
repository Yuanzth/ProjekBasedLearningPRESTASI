<?php
session_start();
include 'includes/db_connect.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_admin = $_POST['id_admin']; // ID Admin yang dimasukkan oleh user
    $password = $_POST['password']; // Password yang dimasukkan oleh user

    // Query untuk memeriksa ID Admin dan Password
    $sql = "SELECT * FROM admin WHERE id_admin = ?";
    $stmt = sqlsrv_prepare($conn, $sql, array($id_admin));

    if ($stmt) {
        sqlsrv_execute($stmt);
        $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($result) {
            // Cek apakah password cocok dengan yang ada di database
            if ($password === $result['password']) { // Cek password langsung tanpa password_verify karena tidak di-hash
                // Login berhasil, set session
                $_SESSION['admin_id'] = $result['id_admin'];
                $_SESSION['admin_nama'] = $result['nama'];

                header("Location: admin_dashboard.php"); // Arahkan ke dashboard admin
                exit();
            } else {
                // Password salah
                echo "<script>alert('ID Admin atau password salah!'); window.location.href='login_admin.php';</script>";
            }
        } else {
            // ID Admin tidak ditemukan
            echo "<script>alert('ID Admin tidak ditemukan!'); window.location.href='login_admin.php';</script>";
        }
    } else {
        // Error pada query
        echo "Error: " . print_r(sqlsrv_errors(), true);
    }
}
?>
