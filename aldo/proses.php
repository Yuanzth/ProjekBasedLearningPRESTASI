<?php
session_start();
include "konek.php"; // File koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna berdasarkan username, password, dan privilege
    $sql = "SELECT * FROM [user] WHERE username = ? AND password = ? AND (privilege = 'A' OR privilege = 'M')";
    
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
            $_SESSION['privilege'] = $result['privilege']; // Menyimpan tipe user

            if ($result['privilege'] == 'A') {
                // Jika user adalah Admin
                header("Location: admin.html"); // Arahkan ke halaman admin
                exit();
            } elseif ($result['privilege'] == 'M') {
                // Jika user adalah Mahasiswa, ambil data tambahan
                $sql_mahasiswa = "SELECT NIM FROM mahasiswa WHERE id_user = ?";
                $stmt_mahasiswa = sqlsrv_prepare($conn, $sql_mahasiswa, array($result['id_user']));

                if ($stmt_mahasiswa) {
                    sqlsrv_execute($stmt_mahasiswa);
                    $mahasiswa = sqlsrv_fetch_array($stmt_mahasiswa, SQLSRV_FETCH_ASSOC);

                    if ($mahasiswa) {
                        // Simpan NIM dalam session
                        $_SESSION['nim'] = $mahasiswa['NIM'];
                    }
                }

                header("Location: mahasiswa.html"); // Arahkan ke halaman mahasiswa
                exit();
            }
        } else {
            // Jika user tidak ditemukan
            echo "<script>alert('Username atau password salah!'); window.location.href='login.html';</script>";
        }
    } else {
        // Jika ada kesalahan dalam menyiapkan statement
        echo "Error in preparing statement: " . print_r(sqlsrv_errors(), true);
    }
}
?>
