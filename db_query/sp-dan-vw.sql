-- stored procedure
DROP PROCEDURE sp_login_admin;
CREATE PROCEDURE sp_login_admin
    @username NVARCHAR(30)
AS
BEGIN
    SET NOCOUNT ON;

    -- Cari pengguna berdasarkan username
    SELECT id_user, username, password_hash, privilege
    FROM tb_user
    WHERE username = @username AND privilege = 'A';
END

-- Get User By Username Login
-- Get User By Username Login
DROP PROCEDURE IF EXISTS sp_GetUserByUsername;
GO

CREATE PROCEDURE sp_GetUserByUsername
    @Username VARCHAR(30)
AS
BEGIN
    SELECT id_user, username, password, privilege
    FROM tb_user 
    WHERE username = @Username;
END;
GO


-- isUsernameExists
DROP PROCEDURE sp_CheckUsernameExists
CREATE PROCEDURE sp_CheckUsernameExists
    @Username VARCHAR(30)
AS
BEGIN
    SELECT 1
    FROM tb_user
    WHERE username = @Username;
END;


-- Register User
DROP PROCEDURE sp_RegisterUser;
CREATE PROCEDURE sp_RegisterUser
    @Username VARCHAR(30),
    @Password NVARCHAR(255),
    @Privileges CHAR(1)
AS
BEGIN
    INSERT INTO tb_user(username, password, privilege)
    VALUES (@Username, @Password, @Privileges);
END;

-- Ambil data mahasiswa dari ID
DROP PROCEDURE IF EXISTS sp_GetMahasiswaByUserId;
GO

CREATE PROCEDURE sp_GetMahasiswaByUserId
    @id_user INT
AS
BEGIN
    SELECT id_mahasiswa, nama, program_studi
    FROM tb_mahasiswa
    WHERE id_user = @id_user;
END;

-- View untuk Semua Prestasi
DROP VIEW vw_AllPrestasi;
CREATE VIEW vw_AllPrestasi AS
SELECT 
    p.id_prestasi,
    m.nama AS mahasiswa,
    k.judul_kompetisi,
    k.tingkat_kompetisi,
    k.tempat_kompetisi,
    k.tanggal_kompetisi,
    d.nama_dosen AS dosen
FROM tb_prestasi p
INNER JOIN tb_mahasiswa m ON p.id_mahasiswa = m.id_mahasiswa
INNER JOIN tb_kompetisi k ON p.id_kompetisi = k.id_kompetisi
INNER JOIN tb_dosen d ON p.id_dosen = d.id_dosen;

-- View untuk Prestasi Saya
DROP VIEW IF EXISTS vw_MyPrestasi;
CREATE VIEW vw_MyPrestasi AS
SELECT 
    p.id_prestasi,
    k.judul_kompetisi,
    k.tingkat_kompetisi,
    k.tempat_kompetisi,
    k.tanggal_kompetisi,
    d.nama_dosen AS dosen,
    k.id_mahasiswa  -- Menambahkan id_mahasiswa
FROM tb_prestasi p
INNER JOIN tb_kompetisi k ON p.id_kompetisi = k.id_kompetisi
INNER JOIN tb_dosen d ON k.id_dosen = d.id_dosen;
 
SELECT * FROM vw_MyPrestasi WHERE id_mahasiswa = 1;
-- menambahkan status validasi berdasarkan nilai kolom valid pada tabel tb_kompetisi
CREATE PROCEDURE sp_GetStatusValidasi
    @id_mahasiswa INT
AS
BEGIN
    SELECT
        k.id_kompetisi,
        k.judul_kompetisi,
        k.tingkat_kompetisi,
        k.tempat_kompetisi,
        k.tanggal_kompetisi,
        k.valid
    FROM
        tb_kompetisi k
    WHERE
        k.id_mahasiswa = @id_mahasiswa
END

-- Store procedure untuk menambahkan pengajuan kompetisi
DROP PROCEDURE sp_InsertKompetisi;
CREATE PROCEDURE sp_InsertKompetisi
    @judul_kompetisi VARCHAR(50),
    @tingkat_kompetisi VARCHAR(20),
    @tempat_kompetisi VARCHAR(50),
    @tanggal_kompetisi DATE,
    @file_surat_tugas VARCHAR(MAX),  -- Mengubah menjadi VARCHAR untuk menerima base64 string
    @file_sertifikat VARCHAR(MAX),   -- Mengubah menjadi VARCHAR untuk menerima base64 string
    @role VARCHAR(10),
    @id_mahasiswa INT,
    @id_dosen INT
AS
BEGIN
    -- Mengonversi string base64 ke VARBINARY(MAX)
    DECLARE @file_surat_tugas_bin VARBINARY(MAX);
    DECLARE @file_sertifikat_bin VARBINARY(MAX);

    SET @file_surat_tugas_bin = CAST('' AS XML).value('xs:base64Binary(sql:variable("@file_surat_tugas"))', 'VARBINARY(MAX)');
    SET @file_sertifikat_bin = CAST('' AS XML).value('xs:base64Binary(sql:variable("@file_sertifikat"))', 'VARBINARY(MAX)');

    -- Memasukkan data ke dalam tabel
    INSERT INTO tb_kompetisi (judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
                              file_surat_tugas, file_sertifikat, role, id_mahasiswa, id_dosen)
    VALUES (@judul_kompetisi, @tingkat_kompetisi, @tempat_kompetisi, @tanggal_kompetisi, 
            @file_surat_tugas_bin, @file_sertifikat_bin, @role, @id_mahasiswa, @id_dosen);
END;



-- Mengambil data dosen yang tersedia
CREATE PROCEDURE sp_GetAllDosen
AS
BEGIN
    SELECT id_dosen, nama_dosen
    FROM tb_dosen
    ORDER BY nama_dosen;
END

-- Stored procedure ini akan mengembalikan file yang disimpan dalam format VARBINARY(MAX).
DROP PROCEDURE sp_getFileKompetisi;
CREATE PROCEDURE sp_GetFileKompetisi
    @id_kompetisi INT
AS
BEGIN
    -- Mengambil file Surat Tugas dan Sertifikat berdasarkan ID kompetisi
    SELECT file_surat_tugas, file_sertifikat
    FROM tb_kompetisi
    WHERE id_kompetisi = @id_kompetisi;
END;

-- Buat stored procedure untuk mengupdate data kompetisi
CREATE PROCEDURE sp_UpdateKompetisi
    @id_kompetisi INT,
    @judul_kompetisi VARCHAR(50),
    @tingkat_kompetisi VARCHAR(20),
    @tempat_kompetisi VARCHAR(50),
    @tanggal_kompetisi DATE,
    @file_surat_tugas VARBINARY(MAX) = NULL,
    @file_sertifikat VARBINARY(MAX) = NULL,
    @role VARCHAR(10),
    @id_dosen INT
AS
BEGIN
    UPDATE tb_kompetisi
    SET
        judul_kompetisi = @judul_kompetisi,
        tingkat_kompetisi = @tingkat_kompetisi,
        tempat_kompetisi = @tempat_kompetisi,
        tanggal_kompetisi = @tanggal_kompetisi,
        file_surat_tugas = CASE WHEN @file_surat_tugas IS NOT NULL THEN @file_surat_tugas ELSE file_surat_tugas END,
        file_sertifikat = CASE WHEN @file_sertifikat IS NOT NULL THEN @file_sertifikat ELSE file_sertifikat END,
        role = @role,
        id_dosen = @id_dosen
    WHERE id_kompetisi = @id_kompetisi;
END;
