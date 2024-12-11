<main>
    <div class="container-fluid my-4">
        <!-- Selamat Datang -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Selamat Datang,
                    <?= isset($data['admin']['nama']) ? htmlspecialchars($data['admin']['nama']) : 'Admin'; ?>!
                </h2>
                <p class="fw-semibold">Beranda Administrasi Sistem</p>
            </div>
        </div>
        <div class="row">
            <!-- kolom bagian kiri -->
            <div class="col-12 col-md-6 mb-3 px-4 d-flex justify-content-center align-items-center">
                <div id="carouselExampleCaptions" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                            aria-label="Slide 5"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"
                            aria-label="Slide 6"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6"
                            aria-label="Slide 7"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= BASE_URL; ?>public/assets/img/user.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/inUser.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/mahasiswa.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/inMahasiswa.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/dosen.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/inDosen.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= BASE_URL; ?>public/assets/img/adminValidasi.png"
                                class="d-block img-fluid border border-black border-5 rounded" alt="...">
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
                    <h1 class="fw-bolder">Beranda Admin</h1>
                    <p>
                        Tampilan Beranda ini memungkinkan Anda untuk mengelola data pengguna, mahasiswa, dosen, validasi
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
                    <h5>Kelola Pengguna</h5>
                    <p>Kelola data pengguna, daftar pengguna baru, dan lihat tabel pengguna di sini.</p>
                </a>
            </div>
            <div class="col-10 col-md-3 m-1">
                <a href="<?= BASE_URL; ?>admin/manageMahasiswa" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/team-management.png" alt="medal">
                    <h5>Kelola Mahasiswa</h5>
                    <p>Kelola data mahasiswa dan koneksikan pengguna ke mahasiswa tertentu.</p>
                </a>
            </div>
            <div class="col-10 col-md-3 m-1">
                <a href="<?= BASE_URL; ?>admin/manageDosen" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/management.png" alt="medal">
                    <h5>Kelola Dosen</h5>
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