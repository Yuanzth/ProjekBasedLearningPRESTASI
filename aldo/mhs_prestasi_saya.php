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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="stylePresSa.css">
        <title>Prestasi | PRESMA</title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg bd-navbar navbar-dark sticky-top">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="/resource/presma.png" alt="Logo Polinema" width="200px" class="me-3">
                </a>
                <!-- Tombol Toggle -->
                <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="mahasiswa.html">
                                <i class="bi bi-house-door"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown-center">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Prestasi</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="mhs_semua_prestasi.php">Semua Prestasi</a></li>
                                <li><a class="dropdown-item nav-link" href="mhs_prestasi_saya.php">Prestasi Saya</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown-center">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kompetisi</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="mhs_pengajuan.php">Pengajuan</a></li>
                                <li><a class="dropdown-item nav-link" href="mhs_status_validasi.php">Status Validasi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown-center">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item nav-link" href="#">Profil</a></li>
                                <li><a class="dropdown-item nav-link" href="logout.php">LogOut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div class="container-fluid my-4">
                <h4 class="d-flex justify-content-center mb-3">Semua Prestasi Anda</h4>                
                <!-- tabel -->
                 <div class="row px-4">
                    <table class="table table-bordered table-hover">
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
                            <?php foreach ($prestasiData as $no => $row): ?>
                                <tr>
                                    <td><?php echo $no + 1; ?></td>
                                    <td><?php echo htmlspecialchars($row['mahasiswa'] ?? ''); ?></td> <!-- Mengakses mahasiswa dengan alias 'mahasiswa' -->
                                    <td><?php echo htmlspecialchars($row['judul_kompetisi']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tempat_kompetisi']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal_kompetisi']->format('d-m-Y')); ?></td> <!-- Format tanggal -->
                                    <td><?php echo htmlspecialchars($row['dosen'] ?? ''); ?></td> <!-- Mengakses dosen dengan alias 'dosen' -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                 </div>
            </div>
        </main>
    </body>
</html>