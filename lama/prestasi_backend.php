<?php
include '../includes/db_connect.php'; // Memasukkan koneksi database

// Fungsi untuk mengambil data prestasi
function prestasi_backend() {
    // Query SQL untuk mengambil data
    $sql = "SELECT p.id_prestasi_nonakademik, p.judul_kompetisi, p.tingkat_kompetisi, p.tempat_kompetisi, p.tanggal_kompetisi, p.role, m.nama AS mahasiswa, d.nama_dosen AS dosen
            FROM prestasi_non_akademik p
            JOIN kompetisi k ON p.id_kompetisi = k.id_kompetisi
            JOIN mahasiswa m ON p.NIM = m.NIM
            JOIN dosen d ON p.NIP = d.NIP";
    
    $stmt = sqlsrv_query($GLOBALS['conn'], $sql);

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
