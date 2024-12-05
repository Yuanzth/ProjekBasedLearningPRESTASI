<?php
session_start();
include 'prestasi_saya_backend.php'; // Memanggil backend untuk mendapatkan data

// Cek apakah user sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login_mhs.php");
    exit();
}

// Mendapatkan NIM mahasiswa yang login
$nim = $_SESSION['nim'];  // Pastikan session nim berisi NIM mahasiswa

// Mendapatkan data prestasi mahasiswa
$prestasiData = prestasi_saya_backend($nim);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Saya</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styles yang sudah ada pada halaman prestasi_semua.php */
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
        .menu-prestasi-saya {
            background-color: #fd7e14; /* Orange */
        }
        .menu-prestasi-saya:hover {
            background-color: #e85c10;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="p-3">Menu</h4>
        <ul>
            <li><a href="dashboard_mhs.php">Dashboard</a></li>
            <li><a href="#">Manage Akun</a></li>
            <li><a href="prestasi_semua.php">Prestasi Semua</a></li>
            <li><a href="logout_mhs.php">Logout</a></li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content" id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="btn btn-light" id="toggle-sidebar">☰</button>
            <a class="navbar-brand ml-3" href="#">Dashboard Mahasiswa</a>
            <div class="ml-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-dark profile-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="User Profile">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="logout_mhs.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Tabel Prestasi Saya -->
        <div class="container mt-4">
            <h1>Prestasi Saya</h1>
            <h3>Berikut adalah prestasi yang telah saya capai dan validasi:</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Kompetisi</th>
                        <th>Tingkat Kompetisi</th>
                        <th>Tempat Kompetisi</th>
                        <th>Tanggal Kompetisi</th>
                        <th>Dosen Pendamping</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($prestasiData)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Data Prestasi anda belum ada</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($prestasiData as $no => $row): ?>
                            <tr>
                                <td><?php echo $no + 1; ?></td>
                                <td><?php echo htmlspecialchars($row['mahasiswa'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['judul_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tempat_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal_kompetisi']->format('d-m-Y')); ?></td> 
                                <td><?php echo htmlspecialchars($row['dosen'] ?? ''); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
