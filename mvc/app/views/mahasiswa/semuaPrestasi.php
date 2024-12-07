<main>
    <div class="container-fluid my-4">
        <h4 class="d-flex justify-content-center mb-3">Semua Prestasi Mahasiswa</h4>
        <div class="row px-4">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Kompetisi</th>
                        <th>Tingkat Kompetisi</th>
                        <th>Tempat Kompetisi</th>
                        <th>Tanggal Kompetisi</th>
                        <th>Dosen Pendamping</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['prestasiData'])): ?>
                        <?php foreach ($data['prestasiData'] as $no => $row): ?>
                            <tr>
                                <td><?= $no + 1; ?></td>
                                <td><?= htmlspecialchars($row['mahasiswa']); ?></td>
                                <td><?= htmlspecialchars($row['judul_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tempat_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tanggal_kompetisi']->format('d-m-Y')); ?></td>
                                <td><?= htmlspecialchars($row['dosen']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data prestasi ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
