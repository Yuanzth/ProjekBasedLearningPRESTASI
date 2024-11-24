<?php
// Path ke file yang akan dimasukkan ke dalam database
$file_path = "C:\\Users\\user\\Downloads\\cihy.png";

// Membaca file dan mengonversinya ke format binary
$file_content = file_get_contents($file_path);

// Menyimpan data file sebagai binary dalam database menggunakan PDO
try {
    $pdo = new PDO("sqlsrv:Server=localhost;Database=db_prestasi_nonakademik", "username", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO kompetisi (id_kompetisi, judul_kompetisi, file_surat_tugas) 
                           VALUES (:id_kompetisi, :judul_kompetisi, :file_surat_tugas)");
    $stmt->bindParam(':id_kompetisi', $id_kompetisi);
    $stmt->bindParam(':judul_kompetisi', $judul_kompetisi);
    $stmt->bindParam(':file_surat_tugas', $file_content, PDO::PARAM_LOB);

    // Contoh data untuk kompetisi
    $id_kompetisi = 'K003';
    $judul_kompetisi = 'Kompetisi Pemrograman';

    // Eksekusi query
    $stmt->execute();

    echo "File berhasil disisipkan ke dalam database.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>