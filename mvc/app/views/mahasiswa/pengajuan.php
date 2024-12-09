<!-- Button untuk membuka modal pengajuan -->
<!-- <div class="col-10 col-md-4 m-1">
    <button class="btn shadow btn-light" data-bs-toggle="modal" data-bs-target="#pengajuanModal">
        <img src="<?= BASE_URL; ?>public/assets/img/contact-form.png" alt="medal">
        <h5>Ajukan Prestasi Anda</h5>
        <p>Anda dapat mengajukan prestasi yang anda miliki disini</p>
    </button>
</div> -->
<main>
    <!-- Modal Pengajuan -->
    <div class="modal modal-lg fade" id="pengajuanModal" tabindex="-1" aria-labelledby="pengajuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengajuanModalLabel">Form Pengajuan Kompetisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="<?= BASE_URL; ?>mahasiswa/ajukanKompetisi" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text shadow" for="judul_kompetisi">Judul Kompetisi</i></span>
                                        <input type="text" class="form-control shadow" id="judul_kompetisi" name="judul_kompetisi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text shadow" for="tingkat_kompetisi">Tingkat Kompetisi</label>
                                        <select class="form-select shadow" id="tingkat_kompetisi" name="tingkat_kompetisi" required>
                                            <option value="">Pilih...</option>
                                            <option value="Lokal">Lokal</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text shadow" for="id_dosen">Dosen Pendamping</label>
                                        <select class="form-control shadow" id="id_dosen" name="id_dosen" required>
                                            <option value="">Pilih Dosen</option>
                                            <?php foreach ($data['dosen'] as $dosenItem): ?>
                                                <option value="<?= $dosenItem['id_dosen']; ?>"><?= htmlspecialchars($dosenItem['nama_dosen']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text shadow" for="tempat_kompetisi">Tempat Kompetisi</label>
                                            <input type="text" class="form-control shadow" id="tempat_kompetisi" name="tempat_kompetisi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text shadow" for="tanggal_kompetisi">Tanggal Kompetisi</label>
                                            <input type="date" class="form-control shadow" id="tanggal_kompetisi" name="tanggal_kompetisi" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text shadow" for="role">Role:</label>
                                            <input type="text" class="form-control shadow" id="role" name="role" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="file_surat_tugas" style="margin-bottom: 0;">Surat Tugas</label>
                                            <input type="file" class="form-control" id="file_surat_tugas" name="file_surat_tugas" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="file_sertifikat" style="margin-bottom: 0;">Sertifikat</label>
                                            <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary w-100">Ajukan Kompetisi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                            <a href="<?= BASE_URL; ?>mahasiswa/deleteKompetisi/<?= $k['id_kompetisi']; ?>" class="btn btn-delete">Hapus</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah default action link
    
                    const url = this.getAttribute('href');
    
                    if (confirm("Anda ingin menghapus data kompetisi ini?")) {
                        window.location.href = url; // Lanjutkan ke URL jika konfirmasi "Ya"
                    }
                });
            });
        });
    </script>
</main>
