<main>
    <div class="container-fluid my-4">
        <h4 class="text-center">Status Validasi Kompetisi</h4>
        <div class="table-responsive px-2">
            <table class="table shadow table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Kompetisi</th>
                        <th>Tingkat Kompetisi</th>
                        <th>Tempat Kompetisi</th>
                        <th>Tanggal Kompetisi</th>
                        <th>Status Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['prestasiData'])): ?>
                        <?php foreach ($data['prestasiData'] as $no => $row): ?>
                            <tr>
                                <td><?= $no + 1; ?></td>
                                <td><?= htmlspecialchars($row['judul_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tingkat_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tempat_kompetisi']); ?></td>
                                <td><?= htmlspecialchars($row['tanggal_kompetisi']->format('d-m-Y')); ?></td>
                                <td class="<?= getStatusClass($row['valid']); ?>">
                                    <?= ($row['valid'] == 'Y') ? 'Tervalidasi' : (($row['valid'] == 'N') ? 'Belum Valid' : 'Ditolak'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data status validasi ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
// Fungsi untuk menentukan kelas warna berdasarkan status validasi
function getStatusClass($status)
{
    switch ($status) {
        case 'Y':
            return 'text-success'; // Hijau untuk tervalidasi
        case 'N':
            return 'text-warning'; // Kuning untuk belum valid
        case 'X':
            return 'text-danger'; // Merah untuk ditolak
        default:
            return '';
    }
}
?>
