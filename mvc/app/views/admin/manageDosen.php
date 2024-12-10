<main>
    <div class="container-fluid my-4">
        <!-- tombol modal tambah user -->
        <div class="row">
            <div class="col-5">
                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambahkan Dosen</a>
            </div>
        </div>
        <!-- modal tambah user -->
         <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Form Tambah Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="nip">NIP</span>
                                    <input type="text" class="form-control shadow" id="nip" name="nip" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="nama_dosen">Nama</span>
                                    <input type="text" class="form-control shadow" id="nama_dosen" name="nama_dosen" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="email_dosen">Email</span>
                                    <input type="text" class="form-control shadow" id="email_dosen" name="email_dosen" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="no_telp_dosen">No. Telp</span>
                                    <input type="text" class="form-control shadow" id="no_telp_dosen" name="no_telp_dosen" required>
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