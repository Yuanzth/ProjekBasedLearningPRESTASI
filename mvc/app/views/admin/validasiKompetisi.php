<main>
    <div class="container-fluid my-4">
        <h3 class="mt-3">Validasi Kompetisi</h3>
        <?php if (!empty($data['kompetisi'])): ?>
        <div class="table-responsive">
            <table class="table table-sm shadow table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Judul</th>
                        <th>Tingkat</th>
                        <th>Tempat</th>
                        <th>Tanggal</th>
                        <th>Role</th>
                        <th>Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['kompetisi'] as $k): ?>
                        <tr>
                            <td><?= htmlspecialchars($k['nama_mahasiswa']); ?></td>
                            <td><?= htmlspecialchars($k['judul_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tingkat_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tempat_kompetisi']); ?></td>
                            <td><?= htmlspecialchars($k['tanggal_kompetisi']->format('Y-m-d')); ?></td>
                            <td><?= htmlspecialchars($k['role']); ?></td>
                            <td><?= htmlspecialchars($k['nama_dosen']); ?></td>
                            <td>
                                <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                                    <input type="hidden" name="id_kompetisi" value="<?= $k['id_kompetisi']; ?>">
                                    <input type="hidden" name="valid" value="Y">
                                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
                                </form>
                                <form action="<?= BASE_URL; ?>admin/setValidasiKompetisi" method="POST" class="d-inline">
                                    <input type="hidden" name="id_kompetisi" value="<?= $k['id_kompetisi']; ?>">
                                    <input type="hidden" name="valid" value="X">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                                </form>
                                <a href="<?= BASE_URL; ?>admin/detailKompetisi/<?= $k['id_kompetisi']; ?>"
                                    class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p>Tidak ada kompetisi yang perlu divalidasi.</p>
        <?php endif; ?>
    </div>
</main>