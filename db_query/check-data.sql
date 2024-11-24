
USE db_prestasi_nonakademik;

SELECT * FROM mahasiswa;

SELECT * FROM [user];

SELECT * FROM admin;

SELECT * FROM kompetisi;

SELECT * FROM prestasi_non_akademik;

SELECT * FROM dosen;

-- Untuk melihat struktur tabel mahasiswa
EXEC sp_help 'mahasiswa';

-- Untuk melihat struktur tabel dosen
EXEC sp_help 'dosen';