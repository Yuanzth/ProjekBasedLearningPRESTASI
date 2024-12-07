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

-- Ambil data semua prestasi
CREATE PROCEDURE sp_GetAllPrestasi
AS
BEGIN
    SELECT 
        p.id_prestasi,
        m.nama AS mahasiswa,
        k.judul_kompetisi,
        k.tingkat_kompetisi,
        k.tempat_kompetisi,
        k.tanggal_kompetisi,
        d.nama_dosen AS dosen
    FROM tb_prestasi p
    INNER JOIN tb_kompetisi k ON p.id_kompetisi = k.id_kompetisi
    INNER JOIN tb_mahasiswa m ON k.id_mahasiswa = m.id_mahasiswa
    LEFT JOIN tb_dosen d ON k.id_dosen = d.id_dosen;
END;


-- Ambil data prestasi dari mahasiswa tertentu
CREATE PROCEDURE sp_GetMyPrestasi
    @id_mahasiswa INT
AS
BEGIN
    SELECT 
        p.id_prestasi,
        k.judul_kompetisi,
        k.tingkat_kompetisi,
        k.tempat_kompetisi,
        k.tanggal_kompetisi,
        d.nama_dosen AS dosen
    FROM tb_prestasi p
    INNER JOIN tb_kompetisi k ON p.id_kompetisi = k.id_kompetisi
    LEFT JOIN tb_dosen d ON k.id_dosen = d.id_dosen
    WHERE k.id_mahasiswa = @id_mahasiswa;
END;



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

