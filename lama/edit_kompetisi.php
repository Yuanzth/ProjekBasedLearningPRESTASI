<?php
session_start();
include '../includes/db_connect.php'; // Koneksi ke database

// Ambil ID kompetisi yang akan diedit
$id_kompetisi = $_GET['id'];

// Query untuk mengambil data kompetisi berdasarkan ID
$sql_kompetisi = "SELECT * FROM kompetisi WHERE id_kompetisi = ?";
$stmt_kompetisi = sqlsrv_query($conn, $sql_kompetisi, array($id_kompetisi));

if ($stmt_kompetisi === false) {
    die(print_r(sqlsrv_errors(), true));
}

$kompetisi = sqlsrv_fetch_array($stmt_kompetisi, SQLSRV_FETCH_ASSOC);

// Query untuk mengambil data dosen
$sql_dosen = "SELECT NIP, nama_dosen FROM dosen ORDER BY nama_dosen";
$stmt_dosen = sqlsrv_query($conn, $sql_dosen);

if ($stmt_dosen === false) {
    die(print_r(sqlsrv_errors(), true));
}

$dosen_list = [];
while ($row = sqlsrv_fetch_array($stmt_dosen, SQLSRV_FETCH_ASSOC)) {
    $dosen_list[] = $row;
}
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

        <?php if (isset($_GET['success'])): ?>
            <p class="text-success">Data kompetisi berhasil diperbarui!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="text-danger">Terjadi kesalahan saat memperbarui data kompetisi.</p>
        <?php endif; ?>

        <form action="process_edit_kompetisi.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kompetisi" value="<?php echo $kompetisi['id_kompetisi']; ?>">

            <div class="form-group">
                <label for="judul_kompetisi">Judul Kompetisi:</label>
                <input type="text" class="form-control" id="judul_kompetisi" name="judul_kompetisi" value="<?php echo htmlspecialchars($kompetisi['judul_kompetisi']); ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="tingkat_kompetisi">Tingkat Kompetisi:</label>
                <select class="form-control" id="tingkat_kompetisi" name="tingkat_kompetisi" required>
                    <option value="Lokal" <?php echo ($kompetisi['tingkat_kompetisi'] == 'Lokal') ? 'selected' : ''; ?>>Lokal</option>
                    <option value="Nasional" <?php echo ($kompetisi['tingkat_kompetisi'] == 'Nasional') ? 'selected' : ''; ?>>Nasional</option>
                    <option value="Internasional" <?php echo ($kompetisi['tingkat_kompetisi'] == 'Internasional') ? 'selected' : ''; ?>>Internasional</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="tempat_kompetisi">Tempat Kompetisi:</label>
                <input type="text" class="form-control" id="tempat_kompetisi" name="tempat_kompetisi" value="<?php echo htmlspecialchars($kompetisi['tempat_kompetisi']); ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="tanggal_kompetisi">Tanggal Kompetisi:</label>
                <input type="date" class="form-control" id="tanggal_kompetisi" name="tanggal_kompetisi" value="<?php echo $kompetisi['tanggal_kompetisi']->format('Y-m-d'); ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role:</label>
                <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($kompetisi['role']); ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="NIP">Dosen Pendamping:</label>
                <select class="form-control" id="NIP" name="NIP" required>
                    <option value="">Pilih Dosen Pendamping</option>
                    <?php foreach ($dosen_list as $dosen): ?>
                        <option value="<?php echo htmlspecialchars($dosen['NIP']); ?>" <?php echo ($kompetisi['NIP'] == $dosen['NIP']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($dosen['nama_dosen']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="file_surat_tugas">Surat Tugas:</label>
                <input type="file" class="form-control-file" id="file_surat_tugas" name="file_surat_tugas" accept=".pdf,.doc,.docx,.jpg,.png">
            </div>

            <div class="form-group mt-3">
                <label for="file_sertifikat">Sertifikat:</label>
                <input type="file" class="form-control-file" id="file_sertifikat" name="file_sertifikat" accept=".pdf,.doc,.docx,.jpg,.png">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update Kompetisi</button>
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
