<?php
session_start();
$kompetisi_data = include 'tambah_kompetisi_backend.php'; // Mengambil data kompetisi

// Jika ada error atau success
$success = isset($_GET['success']);
$error = isset($_GET['error']);

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
    <title>Tambah Kompetisi</title>
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
        <div class="container mt-5">
            <h1>Tambah Kompetisi</h1>

            <?php if (isset($_GET['success'])): ?>
                <p class="text-success">Data kompetisi berhasil ditambahkan!</p>
            <?php elseif (isset($_GET['error'])): ?>
                <p class="text-danger">Terjadi kesalahan saat menambahkan data kompetisi.</p>
            <?php endif; ?>

            <form action="process_tambah_kompetisi.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul_kompetisi">Judul Kompetisi:</label>
                    <input type="text" class="form-control" id="judul_kompetisi" name="judul_kompetisi" required>
                </div>

                <div class="form-group mt-3">
                    <label for="tingkat_kompetisi">Tingkat Kompetisi:</label>
                    <select class="form-control" id="tingkat_kompetisi" name="tingkat_kompetisi" required>
                        <option value="Lokal">Lokal</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="tempat_kompetisi">Tempat Kompetisi:</label>
                    <input type="text" class="form-control" id="tempat_kompetisi" name="tempat_kompetisi" required>
                </div>

                <div class="form-group mt-3">
                    <label for="tanggal_kompetisi">Tanggal Kompetisi:</label>
                    <input type="date" class="form-control" id="tanggal_kompetisi" name="tanggal_kompetisi" required>
                </div>

                <div class="form-group mt-3">
                    <label for="role">Role:</label>
                    <input type="text" class="form-control" id="role" name="role" required>
                </div>
                <div class="form-group mt-3">
                    <label for="nip_dosen">Dosen Pendamping:</label>
                    <select class="form-control" id="nip_dosen" name="nip_dosen" required>
                        <option value="">Pilih Dosen Pendamping</option>
                        <?php foreach ($dosen_list as $dosen): ?>
                            <option value="<?php echo htmlspecialchars($dosen['NIP']); ?>">
                                <?php echo htmlspecialchars($dosen['nama_dosen']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="file_surat_tugas">Surat Tugas:</label>
                    <input type="file" class="form-control-file" id="file_surat_tugas" name="file_surat_tugas" accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>

                <div class="form-group mt-3">
                    <label for="file_sertifikat">Sertifikat:</label>
                    <input type="file" class="form-control-file" id="file_sertifikat" name="file_sertifikat" accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Tambah Kompetisi</button>
            </form>
        </div>

        <?php if (isset($_GET['delete']) && $_GET['delete'] == 'success'): ?>
            <div class="alert alert-success">Data kompetisi berhasil dihapus!</div>
        <?php elseif (isset($_GET['delete']) && $_GET['delete'] == 'error'): ?>
            <div class="alert alert-danger">Gagal menghapus data kompetisi.</div>
        <?php endif; ?>

        <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
            <div class="alert alert-success">Data kompetisi berhasil diperbarui!</div>
        <?php elseif (isset($_GET['update']) && $_GET['update'] == 'error'): ?>
            <div class="alert alert-danger">Gagal memperbarui data kompetisi.</div>
        <?php endif; ?>

        <!-- Tabel Kompetisi Belum Divalidasi -->
        <h2 class="mt-5">Data Kompetisi Belum Divalidasi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kompetisi</th>
                    <th>Tingkat Kompetisi</th>
                    <th>Tempat Kompetisi</th>
                    <th>Tanggal Kompetisi</th>
                    <th>Role</th>
                    <th>Dosen Pendamping</th> <!-- Kolom baru untuk dosen -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kompetisi_data)): ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data kompetisi yang belum divalidasi.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($kompetisi_data as $index => $kompetisi): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($kompetisi['judul_kompetisi']); ?></td>
                            <td><?php echo htmlspecialchars($kompetisi['tingkat_kompetisi']); ?></td>
                            <td><?php echo htmlspecialchars($kompetisi['tempat_kompetisi']); ?></td>
                            <td><?php echo $kompetisi['tanggal_kompetisi']->format('d-m-Y'); ?></td>
                            <td><?php echo htmlspecialchars($kompetisi['role']); ?></td>
                            <td>
                                <!-- Menampilkan nama dosen pendamping berdasarkan NIP -->
                                <?php
                                $nip_dosen = $kompetisi['NIP'];
                                $sql_dosen_nama = "SELECT nama_dosen FROM dosen WHERE NIP = ?";
                                $stmt_dosen_nama = sqlsrv_query($conn, $sql_dosen_nama, array($nip_dosen));
                                $dosen = sqlsrv_fetch_array($stmt_dosen_nama, SQLSRV_FETCH_ASSOC);
                                echo htmlspecialchars($dosen['nama_dosen']);
                                ?>
                            </td>
                            <td>
                                <a href="edit_kompetisi.php?id=<?php echo $kompetisi['id_kompetisi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus_kompetisi.php?id=<?php echo $kompetisi['id_kompetisi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kompetisi ini?')">Hapus</a>
                                
                                <!-- Tombol untuk preview file surat tugas -->
                                <?php if (!empty($kompetisi['file_surat_tugas'])): ?>
                                    <a href="preview_file.php?id=<?php echo $kompetisi['id_kompetisi']; ?>&file=surat_tugas" class="btn btn-info btn-sm" target="_blank">Preview Surat Tugas</a>
                                <?php endif; ?>

                                <!-- Tombol untuk preview file sertifikat -->
                                <?php if (!empty($kompetisi['file_sertifikat'])): ?>
                                    <a href="preview_file.php?id=<?php echo $kompetisi['id_kompetisi']; ?>&file=sertifikat" class="btn btn-info btn-sm" target="_blank">Preview Sertifikat</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>


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
