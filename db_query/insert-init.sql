
-- INSERT DATABASE BARU
USE db_prestasi;

-- Insert data ke tabel tb_admin
INSERT INTO tb_admin (id_user, nama)
SELECT id_user, 'Admin1'
FROM tb_user
WHERE username = 'admin';

-- Insert data mahasiswa dengan id_admin 1

-- Yuan
INSERT INTO tb_mahasiswa (NIM, nama, program_studi, email, no_telp, semester, id_user, id_admin)
SELECT '2341760050', 'Aditya Yuhanda Putra', 'Sistem Informasi Bisnis', 'adityayuhanda3001@gmail.com', '+62 896-0677-5727', 3, id_user, 1
FROM tb_user
WHERE username = 'yuan';

-- Aldo
INSERT INTO tb_mahasiswa (NIM, nama, program_studi, email, no_telp, semester, id_user, id_admin)
SELECT '2341760091', 'Aldo Khrisna Wijaya', 'Sistem Informasi Bisnis', 'aldokhrisna@gmail.com', '+62 895-0359-3601', 3, id_user, 1
FROM tb_user
WHERE username = 'aldo';

-- Icha
INSERT INTO tb_mahasiswa (NIM, nama, program_studi, email, no_telp, semester, id_user, id_admin)
SELECT '2341760042', 'Karina Ika Indasa', 'Sistem Informasi Bisnis', 'karinaika@gmail.com', '+62 822-5004-2722', 3, id_user, 1
FROM tb_user
WHERE username = 'icha';

-- Naya
INSERT INTO tb_mahasiswa (NIM, nama, program_studi, email, no_telp, semester, id_user, id_admin)
SELECT '2341760118', 'Kanaya Abdielaramadhani Hidayat', 'Sistem Informasi Bisnis', 'kanayaabdiela@gmail.com', '+62 818-0946-0175', 3, id_user, 1
FROM tb_user
WHERE username = 'naya';


-- Insert data dosen dengan id_admin 1

INSERT INTO tb_dosen (NIP, nama_dosen, email, no_telp, id_admin)
VALUES 
('199204122019031013', 'Habibie Ed Dien S.Kom., M.T', 'habibie@polinema.ac.id', '081234567892', 1),
('198704242019032017', 'Meyti Eka Apriyani S.T., M.T', 'meyti@polinema.ac.id', '081234567893', 1),
('199006192019031017', 'Bagas Satya Dian Nugraha S.T., M.T', 'bagas@polinema.ac.id', '081234567894', 1);


-- Insert data kompetisi

INSERT INTO tb_kompetisi 
(judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, file_surat_tugas, file_sertifikat, role, id_mahasiswa, id_dosen, valid)
VALUES 
-- Kompetisi untuk Mahasiswa 1
('Lomba Coding Nasional', 'Nasional', 'Jakarta', '2024-01-15', NULL, NULL, 'Peserta', 1, 1, 'Y'),
('Hackathon Kampus', 'Lokal', 'Malang', '2024-02-10', NULL, NULL, 'Ketua', 1, 2, 'N'),
('UI/UX Design Challenge', 'Regional', 'Surabaya', '2024-03-05', NULL, NULL, 'Anggota', 1, 3, 'X'),

-- Kompetisi untuk Mahasiswa 2
('Debat Bahasa Inggris', 'Internasional', 'Bali', '2024-04-20', NULL, NULL, 'Peserta', 2, 1, 'Y'),
('Esai Ilmiah', 'Nasional', 'Yogyakarta', '2024-05-25', NULL, NULL, 'Anggota', 2, 2, 'N'),
('Kompetisi Robotik', 'Regional', 'Bandung', '2024-06-15', NULL, NULL, 'Ketua', 2, 3, 'X'),

-- Kompetisi untuk Mahasiswa 3
('Startup Pitching', 'Internasional', 'Jakarta', '2024-07-10', NULL, NULL, 'Peserta', 3, 1, 'Y'),
('Lomba Animasi', 'Nasional', 'Malang', '2024-08-12', NULL, NULL, 'Anggota', 3, 2, 'N'),
('Cerdas Cermat IT', 'Lokal', 'Surabaya', '2024-09-20', NULL, NULL, 'Ketua', 3, 3, 'X'),

-- Kompetisi untuk Mahasiswa 4
('Game Development', 'Nasional', 'Jakarta', '2024-10-15', NULL, NULL, 'Peserta', 4, 1, 'Y'),
('Cyber Security Contest', 'Internasional', 'Bali', '2024-11-18', NULL, NULL, 'Anggota', 4, 2, 'N'),
('Film Dokumenter', 'Regional', 'Yogyakarta', '2024-12-25', NULL, NULL, 'Ketua', 4, 3, 'X');


-- query untuk memasukkan data kompetisi dengan valid = 'Y' ke tabel tb_prestasi. Data diambil dari tabel tb_kompetisi:

INSERT INTO tb_prestasi (id_kompetisi, role, id_mahasiswa, id_dosen, id_admin)
SELECT 
    id_kompetisi,
    role,
    id_mahasiswa,
    id_dosen,
    1 -- id_admin diisi dengan 1
FROM tb_kompetisi
WHERE valid = 'Y';