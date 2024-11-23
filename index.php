<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa JTI Polinema</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-container {
            max-width: 800px; /* Atur lebar maksimum kontainer sesuai kebutuhan */
            margin: 0 auto; /* Memusatkan kontainer */
        }
    </style>
</head>
<body class="bg-info"> <!-- Menggunakan kelas Bootstrap untuk latar belakang biru muda -->
    <div class="container custom-container text-center mt-5 bg-white p-5 rounded shadow"> <!-- Menggunakan kelas Bootstrap untuk kontainer -->
        <h1 class="text-primary mb-4">Selamat Datang di Halaman Prestasi<br>Jurusan Teknologi Informasi<br>Politeknik Negeri Malang</h1>
        <div class="button-container mt-4">
            <a href="login_mhs.php" class="btn btn-primary btn-lg">Login Mahasiswa</a>
            <a href="login_admin.php" class="btn btn-secondary btn-lg">Login Admin</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>