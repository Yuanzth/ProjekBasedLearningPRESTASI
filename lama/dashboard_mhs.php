<?php
require_once 'fetch_user_data.php'; // Memanggil file fetch_user_data.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #d9edf7;
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }
        .content {
            margin-left: 250px;
            flex: 1;
            transition: margin-left 0.3s;
        }
        .content.collapsed {
            margin-left: 0;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .navbar .navbar-brand {
            color: white;
            font-size: 1.25rem;
        }
        .navbar .navbar-brand:hover {
            color: #e0e0e0;
        }
        .profile-button img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown-menu {
            min-width: 150px;
            right: 0;
            left: auto;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            display: block;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #cce5ff;
        }
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }
        .menu-item {
            width: 200px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .menu-item:hover {
            transform: scale(1.05);
        }
        .menu-tambah {
            background-color: #007bff; /* Biru */
        }
        .menu-tambah:hover {
            background-color: #0056b3;
        }
        .menu-cek-status {
            background-color: #28a745; /* Hijau */
        }
        .menu-cek-status:hover {
            background-color: #1e7e34;
        }
        .menu-prestasi-saya {
            background-color: #fd7e14; /* Orange */
        }
        .menu-prestasi-saya:hover {
            background-color: #e85c10;
        }
        .menu-prestasi-semua {
            background-color: #ffc107; /* Kuning */
        }
        .menu-prestasi-semua:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="p-3">Menu</h4>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Manage Akun</a></li>
            <li><a href="#">Prestasi</a></li>
            <li><a href="logout_mhs.php">Logout</a></li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content" id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="btn btn-light" id="toggle-sidebar">☰</button>
            <a class="navbar-brand ml-3" href="#">Dashboard Mahasiswa</a>
            <!-- Profil Dropdown -->
            <div class="ml-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-dark profile-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Menggunakan gambar profil online, bisa diganti dengan URL yang sesuai -->
                        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="User Profile">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="logout_mhs.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Selamat Datang -->
        <div class="container mt-4">
            <h1>Selamat Datang, <?php echo htmlspecialchars($userData['nama']); ?>!</h1>
            <p>Ini Dashboard Mahasiswa Anda. Program Studi: <b><?php echo htmlspecialchars($userData['program_studi']); ?></b></p>
        </div>

        <!-- Menu di Tengah -->
        <div class="menu-container">
            <a href="tambah_kompetisi.php" class="menu-item menu-tambah">
                Tambah Kompetisi
                <p style="font-size: 12px; margin-top: 10px;">Menu untuk menambahkan record kompetisi yang akan divalidasi admin nantinya</p>
            </a>
            <a href="cek_status_validasi.php" class="menu-item menu-cek-status">
                Cek Status Validasi
                <p style="font-size: 12px; margin-top: 10px;">Menu untuk mengecek status validasi kompetisi yang sudah/belum/tidak divalidasi admin</p>
            </a>
            <a href="prestasi_saya.php" class="menu-item menu-prestasi-saya">
                Prestasi Saya
                <p style="font-size: 12px; margin-top: 10px;">Menu untuk mengecek prestasi yang sudah saya capai</p>
            </a>
            <a href="prestasi_semua.php" class="menu-item menu-prestasi-semua">
                Prestasi Semua
                <p style="font-size: 12px; margin-top: 10px;">Menu untuk melihat prestasi dari keseluruhan mahasiswa</p>
            </a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script untuk Toggle Sidebar -->
    <script>
        const toggleButton = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });
    </script>
</body>
</html>