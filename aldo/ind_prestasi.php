<?php
session_start();
include 'prestasi_backend.php'; // Memanggil backend untuk mendapatkan data

// Mendapatkan data prestasi dari backend
$prestasiData = prestasi_backend();

// Cek apakah data berhasil diambil
if (empty($prestasiData)) {
    echo "Data prestasi tidak tersedia.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="stylePres.css">
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
                            <a class="nav-link" href="index.html">
                                <i class="bi bi-house-door" style="font-size: 17px;"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="nav-link" href="ind_prestasi.php">Prestasi</a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="nav-link" href="ind_about.html">About Us</a>
                        </li>
                        <li class="nav-item d-flex align-items-center px-2">
                            <a href="login.html" class="nav-link">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div class="container-fluid my-4">
                <h4 class="d-flex justify-content-center mb-3">Semua Prestasi Mahasiswa</h4>
                <!-- baris pencarian -->
                <form action="" class="row"  method="post" enctype="multipart/form-data">
                    <div class="col-12 px-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Ketik kata kunci">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Urutkan</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Pilih...</option>
                                <option value="1">Terlama</option>
                                <option value="2">Terbaru</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Tingkat Kompetisi</label>
                            <select class="form-select" id="inputGroupSelect02">
                                <option selected>Pilih...</option>
                                <option value="1">Lokal</option>
                                <option value="2">Nasional</option>
                                <option value="3">Internasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center px-4">
                        <button type="submit" class="btn btn-secondary w-50 mb-3">Cari</button>
                    </div>
                </form>
                <!-- baris tabel -->
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