<main>
    <div class="container my-4">
        <h3 class="mb-4">Validasi Kompetisi</h3>
        <?php if (!empty($data['kompetisi'])): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Kompetisi</th>
                        <th>Judul</th>
                        <th>Tingkat</th>
                        <th>Tempat</th>
                        <th>Tanggal</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['kompetisi'] as $k): ?>
                        <tr>
                            <td><?= htmlspecialchars($k['id_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['judul_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tingkat_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tempat_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tanggal_kompetisi']->format('Y-m-d')); ?></td>
                            <td><?= htmlspecialchars($k['role']); ?></td>
                            <td>
                                <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                                    <input type="hidden" name="id_kompetisi" value="<?= $k['id_kompetisi']; ?>">
                                    <input type="hidden" name="valid" value="Y">
                                    <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                                </form>
                                <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                                    <input type="hidden" name="id_kompetisi" value="<?= $k['id_kompetisi']; ?>">
                                    <input type="hidden" name="valid" value="X">
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                                <a href="<?= BASE_URL; ?>admin/detailKompetisi/<?= $k['id_kompetisi']; ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada kompetisi yang perlu divalidasi.</p>
        <?php endif; ?>
    </div>
</main>
