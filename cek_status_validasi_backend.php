<?php
// Menghubungkan ke database
include 'includes/db_connect.php';

function cek_status_validasi($nim) {
    global $conn;

    // Query untuk mengambil data status validasi kompetisi berdasarkan NIM mahasiswa
    $sql = "SELECT k.judul_kompetisi, k.tingkat_kompetisi, k.tempat_kompetisi, k.tanggal_kompetisi, k.valid
            FROM kompetisi k
            WHERE k.NIM = ?";

    // Menyiapkan statement
    $stmt = sqlsrv_prepare($conn, $sql, array($nim));

    // Mengeksekusi query
    if ($stmt && sqlsrv_execute($stmt)) {
        // Mengambil hasil query
        $results = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    } else {
        return null; // Jika ada error
    }
}
?>
