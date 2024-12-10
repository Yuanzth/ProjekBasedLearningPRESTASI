<main>
    <div class="container-fluid my-4">
        <!-- tombol modal tambah user -->
        <div class="row">
            <div class="col-5">
                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambahkan User</a>
            </div>
        </div>
        <!-- modal tambah user -->
         <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Form Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="username">Username</span>
                                    <input type="text" class="form-control shadow" id="username" name="username" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text shadow" for="password">Password</span>
                                    <input type="text" class="form-control shadow" id="password" name="password" required>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text shadow" for="privilege">Privilege</label>
                                    <select class="form-select shadow" id="privilege" name="privilege" required>
                                        <option value="">Pilih...</option>
                                        <option value="admin">Admin</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambahkan User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</main>