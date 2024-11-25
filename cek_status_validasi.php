<?php
session_start();
include 'cek_status_validasi_backend.php'; // Memanggil backend untuk mendapatkan status validasi kompetisi

// Cek apakah user sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login_mhs.php");
    exit();
}

// Mendapatkan NIM mahasiswa yang login
$nim = $_SESSION['nim'];  // Pastikan session nim berisi NIM mahasiswa

// Mendapatkan data status validasi kompetisi mahasiswa
$kompetisiData = cek_status_validasi($nim);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Validasi</title>
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
            <li><a href="cek_status_validasi.php">Cek Status Validasi</a></li>
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

        <!-- Tabel Cek Status Validasi -->
        <div class="container mt-4">
            <h1>Cek Status Validasi Kompetisi</h1>
            <h3>Berikut adalah status validasi kompetisi yang Anda ikuti:</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Kompetisi</th>
                        <th>Tingkat Kompetisi</th>
                        <th>Tempat Kompetisi</th>
                        <th>Tanggal Kompetisi</th>
                        <th>Status Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kompetisiData)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Data kompetisi tidak tersedia atau belum divalidasi oleh admin.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kompetisiData as $no => $row): ?>
                            <tr>
                                <td><?php echo $no + 1; ?></td>
                                <td><?php echo htmlspecialchars($row['judul_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tempat_kompetisi']); ?></td>
                                <td><?php echo htmlspecialchars($row['tanggal_kompetisi']->format('d-m-Y')); ?></td>
                                <td>
                                    <?php
                                    // Menentukan status validasi
                                    if ($row['valid'] === 'Y') {
                                        echo 'Divalidasi';
                                    } elseif ($row['valid'] === 'N') {
                                        echo 'Belum Divalidasi';
                                    } else {
                                        echo 'Tidak Valid';
                                    }
                                    ?>
                                </td>
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