<main>
    <div class="container my-4">
        <h3 class="mb-4">Detail Kompetisi</h3>
        <table class="table table-bordered">
            <tr>
                <th>ID Kompetisi</th>
                <td><?= htmlspecialchars($data['kompetisi']['id_kompetisi']); ?></td>
            </tr>
            <tr>
                <th>Judul Kompetisi</th>
                <td><?= htmlspecialchars($data['kompetisi']['judul_kompetisi']); ?></td>
            </tr>
            <tr>
                <th>Tingkat Kompetisi</th>
                <td><?= htmlspecialchars($data['kompetisi']['tingkat_kompetisi']); ?></td>
            </tr>
            <tr>
                <th>Tempat Kompetisi</th>
                <td><?= htmlspecialchars($data['kompetisi']['tempat_kompetisi']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Kompetisi</th>
                <td><?= htmlspecialchars($data['kompetisi']['tanggal_kompetisi']->format('Y-m-d')); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?= htmlspecialchars($data['kompetisi']['role']); ?></td>
            </tr>
            <tr>
                <th>Dosen Pembimbing</th>
                <td><?= htmlspecialchars($data['kompetisi']['id_dosen']); ?></td>
            </tr>
            <tr>
                <th>File Surat Tugas</th>
                <td>
                    <?php if (!empty($data['kompetisi']['file_surat_tugas'])): ?>
                        <a href="<?= BASE_URL; ?>admin/previewFile/<?= $data['kompetisi']['id_kompetisi']; ?>/surat_tugas"
                            class="btn btn-info btn-sm" target="_blank">Preview Surat Tugas</a>
                    <?php else: ?>
                        <span class="text-danger">Tidak tersedia</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>File Sertifikat</th>
                <td>
                    <?php if (!empty($data['kompetisi']['file_sertifikat'])): ?>
                        <a href="<?= BASE_URL; ?>admin/previewFile/<?= $data['kompetisi']['id_kompetisi']; ?>/sertifikat"
                            class="btn btn-info btn-sm" target="_blank">Preview Sertifikat</a>
                    <?php else: ?>
                        <span class="text-danger">Tidak tersedia</span>
                    <?php endif; ?>
                </td>
            </tr>

        </table>
        <div class="mt-4">
            <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                <input type="hidden" name="id_kompetisi" value="<?= $data['kompetisi']['id_kompetisi']; ?>">
                <input type="hidden" name="valid" value="Y">
                <button type="submit" class="btn btn-success">Validasi</button>
            </form>
            <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                <input type="hidden" name="id_kompetisi" value="<?= $data['kompetisi']['id_kompetisi']; ?>">
                <input type="hidden" name="valid" value="X">
                <button type="submit" class="btn btn-danger">Tolak</button>
            </form>
            <a href="<?= BASE_URL; ?>admin/validasiKompetisi" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</main>