<?php
$host = "localhost";
$username = "root"; // default username untuk Laragon
$password = ""; // default password untuk Laragon biasanya kosong
$database = "prestasi_bd";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>