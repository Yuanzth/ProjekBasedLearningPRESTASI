<?php
include 'includes/db_connect.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id_prestasi_nonakademik'];
    $judul_kompetisi = $_POST['judul_kompetisi'];
    $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
    $tempat_kompetisi = $_POST['tempat_kompetisi'];
    $tanggal_kompetisi = $_POST['tanggal_kompetisi'];
    $role = $_POST['role'];

    // File upload
    $file_surat_tugas = isset($_FILES['file_surat_tugas']['tmp_name']) && $_FILES['file_surat_tugas']['tmp_name'] !== '' 
                        ? file_get_contents($_FILES['file_surat_tugas']['tmp_name']) 
                        : null;
    $file_sertifikat = isset($_FILES['file_sertifikat']['tmp_name']) && $_FILES['file_sertifikat']['tmp_name'] !== '' 
                        ? file_get_contents($_FILES['file_sertifikat']['tmp_name']) 
                        : null;

    // Query update data
    $sql = "UPDATE prestasi_non_akademik 
            SET judul_kompetisi = ?, tingkat_kompetisi = ?, tempat_kompetisi = ?, tanggal_kompetisi = ?, role = ?
            WHERE id_prestasi_nonakademik = ?";
    $params = array($judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, $tanggal_kompetisi, $role, $id);

    // Tambahkan kondisi untuk file jika ada file baru
    if ($file_surat_tugas) {
        $sql .= ", file_surat_tugas = ?";
        $params[] = $file_surat_tugas;
    }
    if ($file_sertifikat) {
        $sql .= ", file_sertifikat = ?";
        $params[] = $file_sertifikat;
    }

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        // Redirect dengan pesan sukses
        header("Location: tambah_kompetisi.php?update=success");
    } else {
        // Redirect dengan pesan error
        header("Location: tambah_kompetisi.php?update=error");
    }
}
?>
