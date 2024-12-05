<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-container {
            max-width: 800px; /* Atur lebar maksimum kontainer sesuai kebutuhan */
            margin: 0 auto; /* Memusatkan kontainer */
            display: flex; /* Menggunakan flexbox untuk layout */
            align-items: center; /* Memusatkan item secara vertikal */
        }
        .left-side {
            flex: 1; /* Mengambil ruang yang tersedia */
            padding: 20px;
            text-align: center; /* Memusatkan teks di kiri */
        }
        .right-side {
            flex: 1; /* Mengambil ruang yang tersedia */
            padding: 20px;
        }
        .login-form {
            max-width: 400px; /* Atur lebar maksimum form login */
            margin: 0 auto; /* Memusatkan form */
        }
    </style>
</head>
<body class="bg-light"> <!-- Menggunakan latar belakang abu-abu muda -->
    <div class="container custom-container mt-5 bg-white rounded shadow"> <!-- Kontainer utama -->
        <div class="left-side">
            <h2>Selamat Datang</h2>
            <p>Silakan login untuk melanjutkan.</p>
            <!-- Tempat untuk gambar atau elemen lain -->
            <img src="path/to/your/image.jpg" alt="Gambar" class="img-fluid"> <!-- Ganti dengan path gambar yang diinginkan -->
        </div>
        <div class="right-side">
            <div class="login-form">
                <h3 class="text-center">Login Mahasiswa</h3>
                <form action="process_login_mhs.php" method="POST"> <!-- Perbarui action di sini -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>