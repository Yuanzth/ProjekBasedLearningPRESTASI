-- Database Sistem Pencatatan Prestasi Non Akademik

-- 1) Membuat Database
CREATE DATABASE db_prestasi_nonakademik;

USE db_prestasi_nonakademik;

-- 2) Membuat Tabel 
-- Tabel 1: user
CREATE TABLE [user] (
    id_user VARCHAR(10) PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(15) NOT NULL,
    privilege CHAR(1) NOT NULL
);

-- Tabel 2: admin
CREATE TABLE admin (
    id_admin VARCHAR(10) PRIMARY KEY,
    id_user VARCHAR(10) NOT NULL,
    nama VARCHAR(30) NOT NULL,
    password VARCHAR(15) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES [user](id_user)
);

-- Tabel 3: mahasiswa
CREATE TABLE mahasiswa (
    NIM VARCHAR(10) PRIMARY KEY,
    nama VARCHAR(30) NOT NULL,
    program_studi VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    no_telp VARCHAR(30),
    semester INT CHECK (semester > 0),
    id_user VARCHAR(10) NOT NULL,
    id_admin VARCHAR(10),
    FOREIGN KEY (id_user) REFERENCES [user](id_user),
    FOREIGN KEY (id_admin) REFERENCES admin(id_admin)
);

-- Tabel 4: dosen
CREATE TABLE dosen (
    NIP VARCHAR(20) PRIMARY KEY,
    nama_dosen NVARCHAR(100) NOT NULL,
    email VARCHAR(30) NOT NULL,
    no_telp VARCHAR(30),	
    id_admin VARCHAR(10),
    FOREIGN KEY (id_admin) REFERENCES admin(id_admin)
);

-- Tabel 5: kompetisi
CREATE TABLE kompetisi (
    kompetisi_counter INT IDENTITY(1,1) PRIMARY KEY, -- Auto increment
    id_kompetisi VARCHAR(10) UNIQUE NULL, -- ID kompetisi dalam format K001 - K999
    judul_kompetisi VARCHAR(50) NOT NULL,
    tingkat_kompetisi VARCHAR(20) NOT NULL,
    tempat_kompetisi VARCHAR(50),
    tanggal_kompetisi DATE,
    file_surat_tugas VARBINARY(MAX),
    file_sertifikat VARBINARY(MAX),
    role VARCHAR(10),
    NIM VARCHAR(10),
    NIP VARCHAR(20),
    valid CHAR(1) CHECK (valid IN ('Y', 'N', 'X')) DEFAULT 'N',
    FOREIGN KEY (NIM) REFERENCES mahasiswa(NIM),
    FOREIGN KEY (NIP) REFERENCES dosen(NIP)
);

-- Trigger Untuk Penamaan ID (Karena sudah Implementasi Tambah Kompetisi pada web)
CREATE OR ALTER TRIGGER trg_update_id_kompetisi
ON kompetisi
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE k
    SET k.id_kompetisi = 'K' + RIGHT('000' + CAST(k.kompetisi_counter AS VARCHAR(3)), 3)
    FROM kompetisi k
    INNER JOIN inserted i ON k.kompetisi_counter = i.kompetisi_counter
    WHERE k.id_kompetisi IS NULL;
END;


-- Tabel 6: prestasi_non_akademik
CREATE TABLE prestasi_non_akademik (
    id_prestasi_nonakademik VARCHAR(10) PRIMARY KEY,
    judul_kompetisi VARCHAR(50) NOT NULL,
    tingkat_kompetisi VARCHAR(20) NOT NULL,
    tempat_kompetisi VARCHAR(50),
    tanggal_kompetisi DATE,
    file_surat_tugas VARBINARY(MAX),
    file_sertifikat VARBINARY(MAX),
    role VARCHAR(10),
    NIM VARCHAR(10),
    NIP VARCHAR(20),
    id_kompetisi VARCHAR(10),
    id_admin VARCHAR(10),
    FOREIGN KEY (NIM) REFERENCES mahasiswa(NIM),
    FOREIGN KEY (NIP) REFERENCES dosen(NIP),
    FOREIGN KEY (id_kompetisi) REFERENCES kompetisi(id_kompetisi),
    FOREIGN KEY (id_admin) REFERENCES admin(id_admin)
);


-- 3) Mengisi Data pada Tabel 

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


-- 4) Mengecek Data pada Tabel
SELECT * FROM mahasiswa;

SELECT * FROM [user];

SELECT * FROM admin;

SELECT * FROM kompetisi;

SELECT * FROM prestasi_non_akademik;

SELECT * FROM dosen;

-- 5) Membuat Tabel Backup
CREATE TABLE tb_kompetisi_backup (
    id_kompetisi INT,
    judul_kompetisi VARCHAR(50),
    tingkat_kompetisi VARCHAR(20),
    tempat_kompetisi VARCHAR(50),
    tanggal_kompetisi DATE,
    file_surat_tugas VARBINARY(MAX),
    file_sertifikat VARBINARY(MAX),
    role VARCHAR(10),
    id_mahasiswa INT,
    id_dosen INT,
    valid CHAR(1),
    deleted_at DATETIME DEFAULT GETDATE()  -- Menyimpan waktu penghapusan
);