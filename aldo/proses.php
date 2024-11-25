<?php
    include "konek.php";

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
                
                // Ambil NIM mahasiswa berdasarkan username
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
                
                header("Location: mahasiswa.html"); // Arahkan ke halaman dashboard
                exit();
            } else {
                // User tidak ditemukan
                echo "<script>alert('Username atau password salah!'); window.location.href='login.html';</script>";
            }
        } else {
            // Jika ada kesalahan dalam menyiapkan statement
            echo "Error in preparing statement: " . print_r(sqlsrv_errors(), true);
        }
    }
?>