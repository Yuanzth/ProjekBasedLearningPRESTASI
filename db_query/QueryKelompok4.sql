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