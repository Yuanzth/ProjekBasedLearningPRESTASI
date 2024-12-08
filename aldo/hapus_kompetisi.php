<?php
include 'konek.php'; // Koneksi database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data kompetisi
    $sql = "DELETE FROM prestasi_non_akademik WHERE id_prestasi_nonakademik = ?";
    $stmt = sqlsrv_prepare($conn, $sql, array($id));

    if ($stmt && sqlsrv_execute($stmt)) {
        // Redirect ke halaman utama dengan pesan sukses
        header("Location: mhs_pengajuan.php?delete=success");
    } else {
        // Redirect dengan pesan error jika terjadi kesalahan
        header("Location: mhs_pengajuan.php?delete=error");
    }
} else {
    // Jika tidak ada ID, kembalikan ke halaman utama
    header("Location: mhs_pengajuan.php");
}
?>
