<main>
    <div class="container-fluid my-4">
        <!-- Tombol modal tambah dosen -->
        <div class="row">
            <div class="col-5">
                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahDosen">Tambahkan Dosen</a>
            </div>
        </div>
        
        <!-- Tabel daftar dosen -->
        <h2 class="mt-3">Daftar Dosen</h2>
        <div class="table-responsive">
            <table class="table table-sm shadow table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['dosen'] as $d): ?>
                        <tr>
                            <td><?= $d['NIP']; ?></td>
                            <td><?= $d['nama_dosen']; ?></td>
                            <td><?= $d['email']; ?></td>
                            <td><?= $d['no_telp']; ?></td>
                            <td>
                                <a href="<?= BASE_URL; ?>admin/deleteDosen/<?= $d['id_dosen']; ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal tambah dosen -->
        <div class="modal fade" id="tambahDosen" tabindex="-1" aria-labelledby="tambahDosenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDosenModalLabel">Form Tambah Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= BASE_URL; ?>admin/addDosen" method="POST">
                            <div class="mb-3">
                                <label for="NIP" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="NIP" name="NIP" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dosen" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">No. Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tambahkan Dosen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
