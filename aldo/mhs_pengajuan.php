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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="stylePengajuan.css">
        <title>Dashboard | PRESMA</title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-dark sticky-top">
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
                        <li class="nav-item px-2 d-flex align-items-center justify-content-center dropdown">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Prestasi</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="mhs_semua_prestasi.php">Semua Prestasi</a></li>
                                <li><a class="dropdown-item nav-link" href="mhs_prestasi_saya.php">Prestasi Saya</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kompetisi</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="mhs_pengajuan.php">Pengajuan</a></li>
                                <li><a class="dropdown-item nav-link" href="mhs_status_validasi.php">Status Validasi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown">
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
                <!-- form pengajuan -->
                <?php if (isset($_GET['success'])): ?>
                    <p class="text-success">Data kompetisi berhasil ditambahkan!</p>
                <?php elseif (isset($_GET['error'])): ?>
                    <p class="text-danger">Terjadi kesalahan saat menambahkan data kompetisi.</p>
                <?php endif; ?>

                <form action="process_tambah_kompetisi.php" method="post" enctype="multipart/form-data">
                    <h3>Form Pengajuan</h3>
                    <div class="row">
                        <div class="col-10">
                            <div class="input-group mb-3">
                                <span class="input-group-text shadow" for="judul_kompetisi">Judul Kompetisi</i></span>
                                <input type="text" class="form-control shadow" id="judul_kompetisi" name="judul_kompetisi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <label class="input-group-text shadow" for="tingkat_kompetisi">Tingkat Kompetisi</label>
                                <select class="form-select shadow" id="tingkat_kompetisi" name="tingkat_kompetisi" required>
                                    <option value="">Pilih...</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <label class="input-group-text shadow" for="nip_dosen">Dosen Pendamping</label>
                                <select class="form-select shadow" id="nip_dosen" name="nip_dosen" required>
                                    <option value="">Pilih...</option>
                                    <?php foreach ($dosen_list as $dosen): ?>
                                        <option value="<?php echo htmlspecialchars($dosen['NIP']); ?>">
                                            <?php echo htmlspecialchars($dosen['nama_dosen']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="input-group mb-3">
                                <label class="input-group-text shadow" for="tempat_kompetisi">Tempat Kompetisi</label>
                                <input type="text" class="form-control shadow" id="tempat_kompetisi" name="tempat_kompetisi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <label class="input-group-text shadow" for="tanggal_kompetisi">Tanggal Kompetisi</label>
                                <input type="date" class="form-control shadow" id="tanggal_kompetisi" name="tanggal_kompetisi" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group mb-3">
                                <label class="input-group-text shadow" for="role">Role:</label>
                                <input type="text" class="form-control shadow" id="role" name="role" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="mb-3">
                                <label class="form-label" for="file_surat_tugas" style="margin-bottom: 0;">Surat Tugas</label>
                                <input type="file" class="form-control shadow" id="file_surat_tugas" name="file_surat_tugas" accept=".pdf,.doc,.docx,.jpg,.png" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-3">
                                <label class="form-label" for="file_sertifikat" style="margin-bottom: 0;">Sertifikat</label>
                                <input type="file" class="form-control shadow" id="file_sertifikat" name="file_sertifikat" accept=".pdf,.doc,.docx,.jpg,.png" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary w-100">Tambah Kompetisi</button>
                        </div>
                    </div>
                </form>
                <!-- tabel -->
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
                <h2 class="mt-5">Data Pengajuan</h2>
                <div class="table-responsive">
                    <table class="table shadow table-bordered table-hover">
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
                                    <td colspan="8" class="text-center">Tidak ada data pengajuan.</td>
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
            </div>
        </main>
    </body>
</html>