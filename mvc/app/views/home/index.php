<main>
            <div class="container-fluid my-4">
                <div class="row">
                    <!-- kolom bagian kiri -->
                    <div class="col-12 col-md-6 mb-3 px-4 d-flex justify-content-center align-items-center">
                        <div id="carouselExampleCaptions" class="carousel carousel-dark slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= BASE_URL; ?>public/assets/img/presaya.png" class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL; ?>public/assets/img/pengajuan.png" class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL; ?>public/assets/img/inpengajuan.png" class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= BASE_URL; ?>public/assets/img/status.png" class="d-block img-fluid border border-black border-5 rounded" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- kolom bagian kanan -->
                    <div class="col-12 col-md-6 d-flex align-items-center px-4">
                        <div class="flex-column">
                            <h1 class="fw-bolder">PRESMA</h1>
                            <h5>Prestasi Mahasiswa Politeknik Negeri Malang</h5>
                            <p>
                                PRESMA adalah platform untuk mendata dan menampilkan prestasi-prestasi yang diraih oleh mahasiswa POLINEMA di bidang non-akademik baik itu olahraga, seni, maupun kewirausahaan. 
                                PRESMA ini bertujuan untuk mengispirasi mahasiswa lainnya dan memberikan apresiasi atas pencapaian yang telah diraih, serta memperenalkan mahasiswa berprestasi kepada publik.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- baris bawah -->
                <div class="p-3">
                    <h2 class="fw-semibold">Tentang</h2>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="bg-transparent"><i class="bi bi-dot"></i></td>
                            <td class="bg-transparent">Merupakan prestasi dalam bidang non-akademik yang diperoleh secara individu maupun kelompok/tim selama masih tercatat aktif sebagai mahasiswa Politeknik Negeri Malang.</td>
                        </tr>
                        <tr>
                            <td class="bg-transparent"><i class="bi bi-dot"></i></td>
                            <td class="bg-transparent">Merupakan prestasi yang diikuti atas usulan, izin, dan rekomendasi dari Politeknik Negeri Malang dengan dilampirkan Surat Keputusan (SK) atau Surat Tugas dari Politeknik Negeri Malang.</td>
                        </tr>
                        <tr>
                            <td class="bg-transparent"><i class="bi bi-dot"></i></td>
                            <td class="bg-transparent">Prestasi mahasiswa yang diakui adalah prestasi dengan gelarjuara, dengan melampirkan bukti sertifikat.</td>
                        </tr>
                        <tr>
                            <td class="bg-transparent"><i class="bi bi-dot"></i></td>
                            <td class="bg-transparent">Apabila diikuti secara berkelompok setiap anggota wajib mengunggah prestasi yang didapatkan.</td>
                        </tr>
                    </table>
                </div>
                <div class="row d-flex justify-content-center align-items-center p-4">
                    <h4 class="text-center mb-3">Fitur yang dapat digunakan oleh Tamu:</h4>
                    <div class="col-10 col-md-4 m-3">
                        <a href="<?= BASE_URL; ?>home/semuaPrestasi" class="btn shadow btn-light">
                            <img src="<?= BASE_URL; ?>public/assets/img/medal.png" alt="medal">
                            <h5>Prestasi</h5>
                            <p>Anda dapat melihat semua prestasi yang terdaftar disini</p>
                        </a>
                    </div>
                    <div class="col-10 col-md-4 m-3">
                        <a href="<?= BASE_URL; ?>auth/login" class="btn shadow btn-light">
                            <img src="<?= BASE_URL; ?>public/assets/img/pc.png" alt="pc">
                            <h5>Masuk</h5>
                            <p>Anda dapat menggunakan lebih banyak fitur dengan Masuk</p>
                        </a>
                    </div>
                </div>
            </div>
        </main>