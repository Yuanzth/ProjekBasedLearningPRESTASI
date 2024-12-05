<?php
session_start();
include 'konek.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['id_admin']; // ID Admin atau username yang dimasukkan oleh user
    $password = $_POST['password']; // Password yang dimasukkan oleh user

    // Panggil stored procedure untuk memeriksa username dan password hash
    $sql = "EXEC sp_login_admin ?";
    $params = array($username);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Debugging: cek apakah query berhasil disiapkan
    if (!$stmt) {
        echo "Error preparing statement: ";
        print_r(sqlsrv_errors());
        exit();
    }

    $execute_result = sqlsrv_execute($stmt);

    // Debugging: cek apakah query berhasil dieksekusi
    if (!$execute_result) {
        echo "Error executing statement: ";
        print_r(sqlsrv_errors());
        exit();
    }

    $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($result) {
        // Verifikasi password hash menggunakan password_verify
        if (password_verify($password, $result['password_hash'])) {
            // Login berhasil, set session
            $_SESSION['admin_id'] = $result['id_user'];
            $_SESSION['admin_username'] = $result['username'];

            header("Location: admin.html"); // Arahkan ke dashboard admin
            exit();
        } else {
            // Password salah
            echo "<script>alert('Username atau password salah!'); window.location.href='login_admin.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login_admin.php';</script>";
    }
}
?>
