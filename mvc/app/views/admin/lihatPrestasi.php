<main>
    <div class="container my-4">
        <h2 class="text-center mb-4">Daftar Prestasi Mahasiswa</h2>

        <!-- Tabel prestasi -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Nama Prestasi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal Prestasi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['prestasi'])): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data prestasi.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['prestasi'] as $index => $prestasi): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($prestasi['nama_mahasiswa']); ?></td>
                            <td><?= htmlspecialchars($prestasi['program_studi']); ?></td>
                            <td><?= htmlspecialchars($prestasi['nama_prestasi']); ?></td>
                            <td><?= htmlspecialchars($prestasi['kategori']); ?></td>
                            <td><?= date('d-m-Y', strtotime($prestasi['tanggal_prestasi'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
