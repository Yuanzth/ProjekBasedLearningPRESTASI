<div class="container mt-5">
    <h2>Edit Kompetisi</h2>
    <form action="<?= BASE_URL; ?>mahasiswa/updateKompetisi" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_kompetisi" value="<?= $kompetisi['id_kompetisi']; ?>">
        <div class="mb-3">
            <label for="judul_kompetisi" class="form-label">Judul Kompetisi</label>
            <input type="text" class="form-control" name="judul_kompetisi" value="<?= $kompetisi['judul_kompetisi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tingkat_kompetisi" class="form-label">Tingkat Kompetisi</label>
            <input type="text" class="form-control" name="tingkat_kompetisi" value="<?= $kompetisi['tingkat_kompetisi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tempat_kompetisi" class="form-label">Tempat Kompetisi</label>
            <input type="text" class="form-control" name="tempat_kompetisi" value="<?= $kompetisi['tempat_kompetisi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kompetisi" class="form-label">Tanggal Kompetisi</label>
            <input type="date" class="form-control" name="tanggal_kompetisi" value="<?= $kompetisi['tanggal_kompetisi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="file_surat_tugas" class="form-label">File Surat Tugas</label>
            <input type="file" class="form-control" name="file_surat_tugas">
        </div>
        <div class="mb-3">
            <label for="file_sertifikat" class="form-label">File Sertifikat</label>
            <input type="file" class="form-control" name="file_sertifikat">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input type="text" class="form-control" name="role" value="<?= $kompetisi['role']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_dosen" class="form-label">Dosen</label>
            <select class="form-control" name="id_dosen" required>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d['id_dosen']; ?>" <?= $kompetisi['id_dosen'] == $d['id_dosen'] ? 'selected' : ''; ?>>
                        <?= $d['nama_dosen']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="<?= BASE_URL; ?>mahasiswa/updateKompetisi" class="btn btn-secondary">Cancel</a>
    </form>
</div>
