-- Database Sistem Pencatatan Prestasi Non Akademik

-- 1) Membuat Database
CREATE DATABASE db_prestasi;

USE db_prestasi;

-- 2) Membuat Tabel 
-- Tabel 1: user
CREATE TABLE tb_user (
    id_user INT IDENTITY(1,1) PRIMARY KEY,       -- Primary key pengguna dengan auto increment
    username VARCHAR(30) NOT NULL UNIQUE,        -- Username unik
    password NVARCHAR(255) NOT NULL,        -- Hash password
    privilege CHAR(1) NOT NULL CHECK (privilege IN ('A', 'M')) -- Hak akses dengan constraint
);

-- Tabel 2: admin
CREATE TABLE tb_admin (
    id_admin INT IDENTITY(1,1) PRIMARY KEY, -- Auto increment
    id_user INT NOT NULL,
    nama VARCHAR(30) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES tb_user(id_user)
);

-- Tabel 3: mahasiswa
CREATE TABLE tb_mahasiswa (
    id_mahasiswa INT IDENTITY(1,1) PRIMARY KEY, -- Auto increment
    NIM VARCHAR(10) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    program_studi VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    no_telp VARCHAR(30),
    semester INT CHECK (semester > 0),
    id_user INT NOT NULL,                        -- Disesuaikan dengan tipe data di tb_user
    id_admin INT,                                -- Disesuaikan dengan tipe data di tb_admin disini admin berguna untuk ketika ada data input mahasiswa 
    FOREIGN KEY (id_user) REFERENCES tb_user(id_user),
    FOREIGN KEY (id_admin) REFERENCES tb_admin(id_admin)
);


-- Tabel 4: dosen
CREATE TABLE tb_dosen (
	id_dosen INT IDENTITY(1,1) PRIMARY KEY, -- Auto increment
    NIP VARCHAR(20),
    nama_dosen NVARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    no_telp VARCHAR(30),
    id_admin INT,
    FOREIGN KEY (id_admin) REFERENCES tb_admin(id_admin)
);

-- Tabel 5: kompetisi
CREATE TABLE tb_kompetisi (
    id_kompetisi INT IDENTITY(1,1) PRIMARY KEY,            -- Auto increment
    judul_kompetisi VARCHAR(50) NOT NULL,
    tingkat_kompetisi VARCHAR(20) NOT NULL,
    tempat_kompetisi VARCHAR(50),
    tanggal_kompetisi DATE,
    file_surat_tugas VARBINARY(MAX),
    file_sertifikat VARBINARY(MAX),
    role VARCHAR(10),
    id_mahasiswa INT,                                -- Disesuaikan dengan tipe data di tb_mahasiswa
    id_dosen INT,                                    -- Disesuaikan dengan tipe data di tb_dosen
    valid CHAR(1) CHECK (valid IN ('Y', 'N', 'X')) DEFAULT 'N',
    FOREIGN KEY (id_mahasiswa) REFERENCES tb_mahasiswa(id_mahasiswa),
    FOREIGN KEY (id_dosen) REFERENCES tb_dosen(id_dosen)
);

-- Tabel 6: prestasi
CREATE TABLE tb_prestasi (
    id_prestasi INT IDENTITY(1,1) PRIMARY KEY, -- Auto increment
    id_kompetisi INT NOT NULL,                 -- Referensi ke tabel tb_kompetisi
    role VARCHAR(10),                          -- Peran dalam kompetisi
    id_mahasiswa INT,                          -- Referensi ke tabel tb_mahasiswa
    id_dosen INT,                              -- Referensi ke tabel tb_dosen
    id_admin INT,                              -- Referensi ke tabel tb_admin
    FOREIGN KEY (id_kompetisi) REFERENCES tb_kompetisi(id_kompetisi), -- Relasi ke tb_kompetisi
    FOREIGN KEY (id_mahasiswa) REFERENCES tb_mahasiswa(id_mahasiswa), -- Relasi ke tb_mahasiswa
    FOREIGN KEY (id_dosen) REFERENCES tb_dosen(id_dosen),             -- Relasi ke tb_dosen
    FOREIGN KEY (id_admin) REFERENCES tb_admin(id_admin)              -- Relasi ke tb_admin
);

-- Tabel 7: backup
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
    deleted_at DATETIME -- Timestamp penghapusan, diisi oleh trigger
);