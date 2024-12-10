<main>
    <div class="container-fluid my-4">
        <!-- Selamat Datang -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Selamat Datang,
                    <?= isset($data['admin']['nama']) ? htmlspecialchars($data['admin']['nama']) : 'Admin'; ?>!
                </h2>
                <p class="fw-semibold">Dashboard Administrasi Sistem</p>
            </div>
        </div>
            <div class="row">
                <!-- kolom bagian kiri -->
                <div class="col-12 col-md-6 mb-3 px-4 d-flex justify-content-center align-items-center">
                    <div id="carouselExampleCaptions" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= BASE_URL; ?>public/assets/img/ts.jpg"
                                    class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Manajemen Data</h5>
                                    <p>Kelola data user, mahasiswa, dan dosen di sini.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="<?= BASE_URL; ?>public/assets/img/ts.jpg"
                                    class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Validasi Kompetisi</h5>
                                    <p>Periksa dan validasi kompetisi yang diajukan mahasiswa.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- kolom bagian kanan -->
                <div class="col-12 col-md-6 d-flex align-items-center px-4">
                    <div class="flex-column">
                        <h1 class="fw-bolder">Dashboard Admin</h1>
                        <p>
                            Dashboard ini memungkinkan Anda untuk mengelola data user, mahasiswa, dosen, validasi
                            kompetisi, dan melihat prestasi mahasiswa. Gunakan menu di bawah untuk navigasi cepat ke
                            fitur yang tersedia.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Menu Admin -->
            <div class="row d-flex justify-content-center align-items-center p-4">
                <h4 class="text-center mb-3">Fitur yang dapat digunakan oleh Admin:</h4>
                <div class="col-10 col-md-3 m-1">
                    <a href="<?= BASE_URL; ?>admin/manageUser" class="btn shadow btn-light">
                        <img src="<?= BASE_URL; ?>public/assets/img/team-management.png" alt="medal">
                        <h5>Manage User</h5>
                        <p>Kelola data pengguna, daftar user baru, dan lihat tabel user di sini.</p>
                    </a>
                </div>
                <div class="col-10 col-md-3 m-1">
                    <a href="<?= BASE_URL; ?>admin/manageMahasiswa" class="btn shadow btn-light">
                        <img src="<?= BASE_URL; ?>public/assets/img/team-management.png" alt="medal">
                        <h5>Manage Mahasiswa</h5>
                        <p>Kelola data mahasiswa dan koneksikan user ke mahasiswa tertentu.</p>
                    </a>
                </div>
                <div class="col-10 col-md-3 m-1">
                    <a href="<?= BASE_URL; ?>admin/manageDosen" class="btn shadow btn-light">
                        <img src="<?= BASE_URL; ?>public/assets/img/management.png" alt="medal">
                        <h5>Manage Dosen</h5>
                        <p>Kelola data dosen untuk tiap kompetisi.</p>
                    </a>
                </div>
                <div class="col-10 col-md-3 m-1">
                    <a href="<?= BASE_URL; ?>admin/validasiKompetisi" class="btn shadow btn-light">
                        <img src="<?= BASE_URL; ?>public/assets/img/review.png" alt="pc">
                        <h5>Validasi Kompetisi</h5>
                        <p>Periksa dan validasi kompetisi mahasiswa di sini.</p>
                    </a>
                </div>
                <div class="col-10 col-md-3 m-1">
                    <a href="<?= BASE_URL; ?>admin/lihatPrestasi" class="btn shadow btn-light">
                        <img src="<?= BASE_URL; ?>public/assets/img/medal.png" alt="medal">
                        <h5>Lihat Prestasi</h5>
                        <p>Melihat dan mengelola semua prestasi mahasiswa.</p>
                    </a>
                </div>
            </div>
    </div>
</main>