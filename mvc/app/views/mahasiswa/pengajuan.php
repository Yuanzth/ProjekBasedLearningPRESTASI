<!-- Button untuk membuka modal pengajuan -->
<!-- <div class="col-10 col-md-4 m-1">
    <button class="btn shadow btn-light" data-bs-toggle="modal" data-bs-target="#pengajuanModal">
        <img src="<?= BASE_URL; ?>public/assets/img/contact-form.png" alt="medal">
        <h5>Ajukan Prestasi Anda</h5>
        <p>Anda dapat mengajukan prestasi yang anda miliki disini</p>
    </button>
</div> -->

<!-- Modal Pengajuan -->
<div class="modal fade" id="pengajuanModal" tabindex="-1" aria-labelledby="pengajuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pengajuanModalLabel">Form Pengajuan Kompetisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL; ?>mahasiswa/ajukanKompetisi" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judul_kompetisi" class="form-label">Judul Kompetisi</label>
                        <input type="text" class="form-control" id="judul_kompetisi" name="judul_kompetisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="tingkat_kompetisi" class="form-label">Tingkat Kompetisi</label>
                        <input type="text" class="form-control" id="tingkat_kompetisi" name="tingkat_kompetisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="tempat_kompetisi" class="form-label">Tempat Kompetisi</label>
                        <input type="text" class="form-control" id="tempat_kompetisi" name="tempat_kompetisi">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_kompetisi" class="form-label">Tanggal Kompetisi</label>
                        <input type="date" class="form-control" id="tanggal_kompetisi" name="tanggal_kompetisi" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_surat_tugas" class="form-label">Surat Tugas</label>
                        <input type="file" class="form-control" id="file_surat_tugas" name="file_surat_tugas" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_sertifikat" class="form-label">Sertifikat</label>
                        <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role">
                    </div>
                    <div class="mb-3">
                        <label for="id_dosen" class="form-label">Pilih Dosen</label>
                        <select class="form-control" id="id_dosen" name="id_dosen" required>
                            <option value="">Pilih Dosen</option>
                            <?php foreach ($data['dosen'] as $dosenItem): ?>
                                <option value="<?= $dosenItem['id_dosen']; ?>"><?= htmlspecialchars($dosenItem['nama_dosen']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajukan Kompetisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tombol Ajukan Kompetisi -->
<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuanModal">Ajukan Prestasi Anda</a>

<!-- Tabel Kompetisi yang Belum Divalidasi -->
<table class="table">
    <thead>
        <tr>
            <th>Judul Kompetisi</th>
            <th>Tingkat Kompetisi</th>
            <th>Tempat Kompetisi</th>
            <th>Tanggal Kompetisi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['kompetisi'])): ?>
            <?php foreach ($data['kompetisi'] as $k): ?>
                <tr>
                    <td><?= htmlspecialchars($k['judul_kompetisi']); ?></td>
                    <td><?= htmlspecialchars($k['tingkat_kompetisi']); ?></td>
                    <td><?= htmlspecialchars($k['tempat_kompetisi']); ?></td>
                    <td><?= htmlspecialchars($k['tanggal_kompetisi']->format('Y-m-d')); ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>mahasiswa/editKompetisi/<?= $k['id_kompetisi']; ?>" class="btn btn-warning">Edit</a>
                        <a href="hapus_kompetisi.php?id=<?= $k['id_kompetisi']; ?>" class="btn btn-delete">Hapus</a>
                        <!-- Tombol untuk preview file surat tugas -->
                        <?php if (!empty($k['file_surat_tugas'])): ?>
                            <a href="<?= BASE_URL; ?>mahasiswa/previewFile/<?= $k['id_kompetisi']; ?>/surat_tugas" 
                            class="btn btn-info btn-sm" target="_blank">Preview Surat Tugas</a>
                        <?php endif; ?>

                        <!-- Tombol untuk preview file sertifikat -->
                        <?php if (!empty($k['file_sertifikat'])): ?>
                            <a href="<?= BASE_URL; ?>mahasiswa/previewFile/<?= $k['id_kompetisi']; ?>/sertifikat" 
                            class="btn btn-info btn-sm" target="_blank">Preview Sertifikat</a>
                        <?php endif; ?>


                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada kompetisi yang diajukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
