<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_mhs.php"); // Redirect jika belum login
    exit();
}
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
            overflow-x: hidden; /* Hindari scroll horizontal */
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
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Manage Akun</a></li>
            <li><a href="#">Prestasi</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content" id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="btn btn-light" id="toggle-sidebar">☰</button>
            <a class="navbar-brand ml-3" href="#">Dashboard Mahasiswa</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle profile-button" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="User Photo">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container mt-4">
            <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Ini adalah halaman dashboard untuk mahasiswa.</p>
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
