<div class="container mt-5 mb-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Edit Kompetisi</h3>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL; ?>mahasiswa/updateKompetisi" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_kompetisi" value="<?= $data['kompetisi']['id_kompetisi']; ?>">
                
                <!-- Judul Kompetisi -->
                <div class="mb-4">
                    <label for="judul_kompetisi" class="form-label fw-bold">Judul Kompetisi</label>
                    <input type="text" class="form-control rounded-pill" name="judul_kompetisi" 
                           value="<?= $data['kompetisi']['judul_kompetisi']; ?>" required>
                </div>
                
                <!-- Tingkat Kompetisi -->
                <div class="mb-4">
                    <label for="tingkat_kompetisi" class="form-label fw-bold">Tingkat Kompetisi</label>
                    <input type="text" class="form-control rounded-pill" name="tingkat_kompetisi" 
                           value="<?= $data['kompetisi']['tingkat_kompetisi']; ?>" required>
                </div>
                
                <!-- Tempat Kompetisi -->
                <div class="mb-4">
                    <label for="tempat_kompetisi" class="form-label fw-bold">Tempat Kompetisi</label>
                    <input type="text" class="form-control rounded-pill" name="tempat_kompetisi" 
                           value="<?= $data['kompetisi']['tempat_kompetisi']; ?>" required>
                </div>
                
                <!-- Tanggal Kompetisi -->
                <div class="mb-4">
                    <label for="tanggal_kompetisi" class="form-label fw-bold">Tanggal Kompetisi</label>
                    <input type="date" class="form-control rounded-pill" name="tanggal_kompetisi" 
                        value="<?= isset($data['kompetisi']['tanggal_kompetisi']) 
                                        ? $data['kompetisi']['tanggal_kompetisi']->format('Y-m-d') 
                                        : ''; ?>" required>
                </div>

                
                <!-- File Surat Tugas -->
                <div class="mb-4">
                    <label for="file_surat_tugas" class="form-label fw-bold">File Surat Tugas</label>
                    <input type="file" class="form-control rounded-pill" name="file_surat_tugas">
                </div>
                
                <!-- File Sertifikat -->
                <div class="mb-4">
                    <label for="file_sertifikat" class="form-label fw-bold">File Sertifikat</label>
                    <input type="file" class="form-control rounded-pill" name="file_sertifikat">
                </div>
                
                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="form-label fw-bold">Role</label>
                    <input type="text" class="form-control rounded-pill" name="role" 
                           value="<?= $data['kompetisi']['role']; ?>" required>
                </div>
                
                <!-- Dosen -->
                <div class="mb-4">
                    <label for="id_dosen" class="form-label fw-bold">Dosen</label>
                    <select class="form-control rounded-pill" name="id_dosen" required>
                        <?php foreach ($data['dosen'] as $d): ?>
                            <option value="<?= $d['id_dosen']; ?>" 
                                    <?= $data['kompetisi']['id_dosen'] == $d['id_dosen'] ? 'selected' : ''; ?>>
                                <?= $d['nama_dosen']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="<?= BASE_URL; ?>mahasiswa/ajukanKompetisi" class="btn btn-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
