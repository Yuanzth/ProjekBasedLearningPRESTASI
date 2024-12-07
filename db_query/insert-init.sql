
USE db_prestasi_nonakademik;

-- Data untuk mahasiswa
INSERT INTO [user] (id_user, username, password, privilege) VALUES
('U001', 'mahasiswa1', 'pass123', 'M'),
('U002', 'mahasiswa2', 'pass123', 'M'),
-- Data untuk admin
('U003', 'admin1', 'adminpass', 'A');

-- Admin
INSERT INTO admin (id_admin, id_user, nama, password) VALUES
('A001', 'U003', 'Admin Satu', 'adminpass');

-- Mahasiswa
INSERT INTO mahasiswa (NIM, nama, program_studi, email, no_telp, semester, id_user, id_admin) VALUES
('M001', 'Aditya Yuhanda', 'Teknologi Informasi', 'aditya@mail.com', '081234567890', 5, 'U001', 'A001'),
('M002', 'Aldo Wijaya', 'Teknologi Informasi', 'aldo@mail.com', '081234567891', 5, 'U002', 'A001');

-- Dosen
INSERT INTO dosen (NIP, nama_dosen, email, no_telp, id_admin) VALUES
('D001', 'Habibie Ed Dien S.Kom., M.T', 'habibie@mail.com', '081234567892', 'A001'),
('D002', 'Meyti Eka Apriyani S.T., M.T', 'meyti@mail.com', '081234567893', 'A001'),
('D003', 'Bagas Satya Dian Nugraha S.T., M.T', 'bagas@mail.com', '081234567894', 'A001');


-- Tambahkan data ke tabel `kompetisi` (dengan kolom valid)
INSERT INTO kompetisi (id_kompetisi, judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, role, NIM, NIP, valid) VALUES
('K001', 'Hackathon 2024', 'Nasional', 'Jakarta', '2024-12-01', 'Peserta', 'M001', 'D001', 'Y'), -- Sudah divalidasi
('K002', 'IoT Championship', 'Regional', 'Surabaya', '2024-12-15', 'Peserta', 'M002', 'D002', 'N'); -- Belum divalidasi

-- Tambahkan data ke tabel `prestasi_non_akademik`
INSERT INTO prestasi_non_akademik (id_prestasi_nonakademik, judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, role, NIM, NIP, id_kompetisi, id_admin) VALUES
('P001', 'Hackathon 2024', 'Nasional', 'Jakarta', '2024-12-01', 'Peserta', 'M001', 'D001', 'K001', 'A001'); -- Valid (sudah masuk prestasi)


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

