<main>
    <div class="container-fluid my-4">
        <!-- tombol modal tambah user -->
        <div class="row">
            <div class="col-5">
                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambahkan Mahasiswa</a>
            </div>
        </div>
        <!-- modal tambah user -->
         <div class="modal modal-lg fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Form Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="username">Username</span>
                                            <input type="text" class="form-control shadow" id="username" name="username" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="nim">NIM</span>
                                            <input type="text" class="form-control shadow" id="nim" name="nim" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="nama_mahasiswa">Nama</span>
                                            <input type="text" class="form-control shadow" id="nama_mahasiswa" name="nama_mahasiswa" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                        <label class="input-group-text shadow" for="program_studi">Program Studi</label>
                                        <select class="form-select shadow" id="program_studi" name="program_studi" required>
                                            <option value="">Pilih...</option>
                                            <option value="ti">Teknik Informatika</option>
                                            <option value="sib">Sistem Informasi Bisnis</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="no_telp_mahasiswa">No. Telp</span>
                                            <input type="text" class="form-control shadow" id="no_telp_mahasiswa" name="no_telp_mahasiswa" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="email_mahasiswa">Email</span>
                                            <input type="text" class="form-control shadow" id="email_mahasiswa" name="email_mahasiswa" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambahkan Dosen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</main>