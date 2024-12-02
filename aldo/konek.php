<?php

//Buat nama serverName nya itu pake nama server yang windows authentication kalian, 
//tapi nanti jangan dicommit buat perubahan nama laptop nya

// Konfigurasi koneksi database
$serverName = "LAPTOP-BCLGTLTG"; // Nama server
$connectionInfo = array("Database" => "db_prestasi_nonakademik"); // Nama database
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Cek koneksi
if ($conn === false) {
    // Log error ke file
    logError(sqlsrv_errors());

    // Berikan pesan error kepada pengguna
    die("Terjadi kesalahan saat menghubungkan ke database. Silakan coba lagi.");
}
?>
