<?php
include 'konek.php'; // Memasukkan koneksi database

// Fungsi untuk mengambil data prestasi milik mahasiswa yang login
function prestasi_saya_backend($nim) {
    // Query SQL untuk mengambil data prestasi mahasiswa yang valid
    $sql = "SELECT p.id_prestasi_nonakademik, p.judul_kompetisi, p.tingkat_kompetisi, p.tempat_kompetisi, p.tanggal_kompetisi, p.role, m.nama AS mahasiswa, d.nama_dosen AS dosen
            FROM prestasi_non_akademik p
            JOIN kompetisi k ON p.id_kompetisi = k.id_kompetisi
            JOIN mahasiswa m ON p.NIM = m.NIM
            JOIN dosen d ON p.NIP = d.NIP
            WHERE p.NIM = ? AND k.valid = 'Y'"; // Menggunakan NIM untuk mengambil data

    // Menyiapkan dan mengeksekusi query
    $stmt = sqlsrv_query($GLOBALS['conn'], $sql, array($nim));

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }

    sqlsrv_free_stmt($stmt);
    return $data;
}
?>
