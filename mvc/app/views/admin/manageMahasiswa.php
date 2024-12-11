<main>
    <div class="container-fluid my-4">
        <!-- Tombol modal tambah mahasiswa -->
        <div class="row">
            <div class="col-5">
                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambahkan Mahasiswa</a>
            </div>
        </div>
        
        <!-- Tabel daftar mahasiswa -->
         <h2 class="mt-3">Daftar Mahasiswa</h2>
         <div class="table-responsive">
             <table class="table table-sm shadow table-bordered table-hover">
                 <thead>
                     <tr>
                         <th>NIM</th>
                         <th>Nama</th>
                         <th>Program Studi</th>
                         <th>Email</th>
                         <th>No. Telp</th>
                         <th>Semester</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($data['mahasiswa'] as $m): ?>
                         <tr>
                             <td><?= $m['NIM']; ?></td>
                             <td><?= $m['nama']; ?></td>
                             <td><?= $m['program_studi']; ?></td>
                             <td><?= $m['email']; ?></td>
                             <td><?= $m['no_telp']; ?></td>
                             <td><?= $m['semester']; ?></td>
                             <td>
                                 <!-- <a href="<?= BASE_URL; ?>admin/editMahasiswa/<?= $m['id_mahasiswa']; ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></a> -->
                                 <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal"><i class="bi bi-trash"></i></a>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Perhatian!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                            <h6>Apakah anda yakin akan menghapus?</h6>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="<?= BASE_URL; ?>admin/deleteMahasiswa/<?= $m['id_mahasiswa']; ?>" class="btn btn-outline-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal tambah mahasiswa -->
        <div class="modal modal-lg fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Form Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="<?= BASE_URL; ?>admin/addMahasiswa" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="username">Username</span>
                                            <input type="text" class="form-control shadow" id="username" name="username" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="NIM">NIM</span>
                                            <input type="text" class="form-control shadow" id="NIM" name="NIM" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="nama">Nama</span>
                                            <input type="text" class="form-control shadow" id="nama" name="nama" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text shadow" for="program_studi">Program Studi</label>
                                            <select class="form-select shadow" id="program_studi" name="program_studi" required>
                                                <option value="">Pilih...</option>
                                                <option value="Teknik Informatika">Teknik Informatika</option>
                                                <option value="Sistem Informasi Bisnis">Sistem Informasi Bisnis</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="semester">Semester</span>
                                            <input type="number" class="form-control shadow" id="semester" name="semester" min="1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="no_telp">No. Telp</span>
                                            <input type="text" class="form-control shadow" id="no_telp" name="no_telp" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text shadow" for="email">Email</span>
                                            <input type="email" class="form-control shadow" id="email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambahkan Mahasiswa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>