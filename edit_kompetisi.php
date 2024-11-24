<?php
include 'includes/db_connect.php'; // Koneksi database

if (!isset($_GET['id'])) {
    // Redirect jika tidak ada ID
    header("Location: tambah_kompetisi.php");
    exit;
}

$id = $_GET['id'];

// Ambil data kompetisi berdasarkan ID
$sql = "SELECT * FROM prestasi_non_akademik WHERE id_prestasi_nonakademik = ?";
$stmt = sqlsrv_prepare($conn, $sql, array($id));
sqlsrv_execute($stmt);
$data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$data) {
    // Redirect jika data tidak ditemukan
    header("Location: tambah_kompetisi.php?notfound=1");
    exit;
}

// Jika data ditemukan, tampilkan form untuk edit
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kompetisi</title>
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
<div class="container mt-5">
    <h1>Edit Kompetisi</h1>

    <form action="edit_kompetisi_backend.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_prestasi_nonakademik" value="<?php echo $data['id_prestasi_nonakademik']; ?>">

        <div class="form-group">
            <label for="judul_kompetisi">Judul Kompetisi</label>
            <input type="text" class="form-control" id="judul_kompetisi" name="judul_kompetisi"
                   value="<?php echo htmlspecialchars($data['judul_kompetisi']); ?>" required>
        </div>

        <div class="form-group">
            <label for="tingkat_kompetisi">Tingkat Kompetisi</label>
            <input type="text" class="form-control" id="tingkat_kompetisi" name="tingkat_kompetisi"
                   value="<?php echo htmlspecialchars($data['tingkat_kompetisi']); ?>" required>
        </div>

        <div class="form-group">
            <label for="tempat_kompetisi">Tempat Kompetisi</label>
            <input type="text" class="form-control" id="tempat_kompetisi" name="tempat_kompetisi"
                   value="<?php echo htmlspecialchars($data['tempat_kompetisi']); ?>">
        </div>

        <div class="form-group">
            <label for="tanggal_kompetisi">Tanggal Kompetisi</label>
            <input type="date" class="form-control" id="tanggal_kompetisi" name="tanggal_kompetisi"
                   value="<?php echo $data['tanggal_kompetisi']->format('Y-m-d'); ?>" required>
        </div>

        <div class="form-group">
            <label for="file_surat_tugas">File Surat Tugas</label>
            <input type="file" class="form-control" id="file_surat_tugas" name="file_surat_tugas">
        </div>

        <div class="form-group">
            <label for="file_sertifikat">File Sertifikat</label>
            <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" class="form-control" id="role" name="role"
                   value="<?php echo htmlspecialchars($data['role']); ?>">
        </div>

        <button type="submit" class="btn btn-success">Update Kompetisi</button>
        <a href="tambah_kompetisi.php" class="btn btn-secondary">Kembali</a>
    </form>
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
