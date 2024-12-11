<main>
    <div class="container-fluid my-4">
        <!-- Selamat Datang -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Selamat Datang, <?= isset($data['mahasiswa']['nama']) ? $data['mahasiswa']['nama'] : 'Pengguna'; ?>!</h2>
                <p class="fw-semibold">Program Studi: <?= isset($data['mahasiswa']['program_studi']) ? $data['mahasiswa']['program_studi'] : 'Tidak Diketahui'; ?></p>
            </div>
        </div>
        <!-- Counter -->
        <div class="row counter d-flex justify-content-center align-items-center p-4">
            <div class="col-6 col-lg-3">
                <button type="button" class="btn shadow w-100" style="background-color: #198754;">
                    <i class="bi bi-check2-circle"></i>
                    <h6>Tervalidasi</h6>
                    <span class="badge"><?= $data['statusCounts']['count_valid'] ?? 0; ?></span>
                </button>
            </div>
            <div class="col-6 col-lg-3">
                <button type="button" class="btn shadow w-100" style="background-color: #ffc107;">
                    <i class="bi bi-stopwatch"></i>
                    <h6>Belum Tervalidasi</h6>
                    <span class="badge"><?= $data['statusCounts']['count_pending'] ?? 0; ?></span>
                </button>
            </div>
            <div class="col-6 col-lg-3">
                <button type="button" class="btn shadow w-100" style="background-color: #dc3545;">
                    <i class="bi bi-x-circle"></i>
                    <h6>Tidak Valid</h6>
                    <span class="badge"><?= $data['statusCounts']['count_invalid'] ?? 0; ?></span>
                </button>
            </div>
        </div>
         <!-- fitur -->
        <div class="row d-flex justify-content-center align-items-center p-4">
            <h4 class="text-center mb-3">Fitur yang dapat digunakan oleh Mahasiswa:</h4>
            <div class="col-10 col-md-4 m-1">
                <a href="<?= BASE_URL; ?>mahasiswa/semuaPrestasi" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/medal.png" alt="medal">
                    <h5>Semua Prestasi</h5>
                    <p>Anda dapat melihat semua prestasi yang terdaftar disini</p>
                </a>
            </div>
            <div class="col-10 col-md-4 m-1">
                <a href="<?= BASE_URL; ?>mahasiswa/prestasiSaya" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/sertificate.png" alt="pc">
                    <h5>Prestasi Saya</h5>
                    <p>Anda dapat melihat semua prestasi anda yang terdaftar disini</p>
                </a>
            </div>
            <div class="col-10 col-md-4 m-1">
                <a href="<?= BASE_URL; ?>mahasiswa/ajukanKompetisi" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/contact-form.png" alt="medal">
                    <h5>Pengajuan</h5>
                    <p>Anda dapat mengajukan prestasi yang anda miliki disini</p>
                </a>
            </div>
            <div class="col-10 col-md-4 m-1">
                <a href="<?= BASE_URL; ?>mahasiswa/statusValidasi" class="btn shadow btn-light">
                    <img src="<?= BASE_URL; ?>public/assets/img/review.png" alt="pc">
                    <h5>Status Validasi</h5>
                    <p>Anda dapat melihat status validasi pengajuan yang anda lakukan disini</p>
                </a>
            </div>
        </div>
    </div>
</main>