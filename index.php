<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa JTI Polinema</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Halaman Prestasi<br>Jurusan Teknologi Informasi<br>Politeknik Negeri Malang</h1>
        <div class="button-container">
            <a href="login.php?role=mahasiswa" class="button">Login Mahasiswa</a>
            <a href="login.php?role=admin" class="button">Login Admin</a>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>