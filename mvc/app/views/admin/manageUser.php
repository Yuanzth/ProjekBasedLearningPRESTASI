<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styleKelDos.css">
        <title>Manage User | PRESMA</title>
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="/resource/presma.png" alt="Logo Polinema" width="200px" class="me-3">
                </a>
                <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item px-2">
                            <a class="nav-link" href="<?= BASE_URL; ?>admin">
                                <i class="bi bi-house-door"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="nav-link" href="<?= BASE_URL; ?>admin/validasiKompetisi">Validasi Kompetisi</a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="nav-link" href="<?= BASE_URL; ?>admin/manageDosen">Kelola Dosen</a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">
                            <a class="nav-link" href="<?= BASE_URL; ?>admin/manageMahasiswa">Kelola Mahasiswa</a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center dropdown">
                            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item nav-link" href="#">Profil</a></li>
                                <li><a class="dropdown-item nav-link" href="<?= BASE_URL; ?>logout">LogOut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <main>
            <div class="container-fluid my-4">
                <h3>Kelola User</h3>
                <form action="<?= BASE_URL; ?>admin/addUser" method="post">
                    <div class="row mb-3">
                        <div class="col-10">
                            <div class="input-group">
                                <span class="input-group-text shadow">Nama User</span>
                                <input type="text" class="form-control shadow" name="nama_user" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-10">
                            <div class="input-group">
                                <span class="input-group-text shadow">Email</span>
                                <input type="email" class="form-control shadow" name="email_user" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-10">
                            <div class="input-group">
                                <span class="input-group-text shadow">Password</span>
                                <input type="password" class="form-control shadow" name="password_user" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary w-100">Tambah User</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h3>Daftar User</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id_user']); ?></td>
                                <td><?= htmlspecialchars($user['nama']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <a href="<?= BASE_URL; ?>admin/editUser/<?= $user['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= BASE_URL; ?>admin/deleteUser/<?= $user['id_user']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
