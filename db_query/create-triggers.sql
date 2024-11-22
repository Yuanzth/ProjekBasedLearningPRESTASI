

USE db_prestasi_nonakademik;

-- 
CREATE TRIGGER trg_kompetisi_log
ON kompetisi
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    DECLARE @id_user VARCHAR(10), @nama_user VARCHAR(30), @aktivitas VARCHAR(100), @waktu DATETIME;
    SET @waktu = GETDATE();

    -- Ambil data user dari konteks (HARUS DISESUAIKAN DENGAN SISTEM LOGIN)
    -- Misalnya, data user aktif disimpan dalam variabel SESSION saat implementasi web
    SELECT @id_user = SUSER_NAME(); -- Placeholder untuk user ID

    -- Ambil nama user dari tabel user
    SELECT @nama_user = username FROM [user] WHERE id_user = @id_user;

    -- Operasi INSERT
    IF EXISTS (SELECT * FROM INSERTED) AND NOT EXISTS (SELECT * FROM DELETED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' menambahkan data kompetisi.');
    END

    -- Operasi UPDATE
    IF EXISTS (SELECT * FROM INSERTED) AND EXISTS (SELECT * FROM DELETED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' memperbarui data kompetisi.');
    END

    -- Operasi DELETE
    IF EXISTS (SELECT * FROM DELETED) AND NOT EXISTS (SELECT * FROM INSERTED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' menghapus data kompetisi.');
    END

    -- Masukkan ke tabel history
    INSERT INTO history (id_log, aktivitas, waktu, id_user)
    VALUES (NEWID(), @aktivitas, @waktu, @id_user);
END;


CREATE TRIGGER trg_mahasiswa_log
ON mahasiswa
AFTER INSERT, UPDATE, DELETE
AS
BEGIN
    DECLARE @id_user VARCHAR(10), @nama_user VARCHAR(30), @aktivitas VARCHAR(100), @waktu DATETIME;
    SET @waktu = GETDATE();

    -- Ambil data user dari konteks
    SELECT @id_user = SUSER_NAME(); -- Placeholder untuk user ID
    SELECT @nama_user = username FROM [user] WHERE id_user = @id_user;

    -- Operasi INSERT
    IF EXISTS (SELECT * FROM INSERTED) AND NOT EXISTS (SELECT * FROM DELETED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' menambahkan data mahasiswa.');
    END

    -- Operasi UPDATE
    IF EXISTS (SELECT * FROM INSERTED) AND EXISTS (SELECT * FROM DELETED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' memperbarui data mahasiswa.');
    END

    -- Operasi DELETE
    IF EXISTS (SELECT * FROM DELETED) AND NOT EXISTS (SELECT * FROM INSERTED)
    BEGIN
        SET @aktivitas = CONCAT('User ', @nama_user, ' menghapus data mahasiswa.');
    END

    -- Masukkan ke tabel history
    INSERT INTO history (id_log, aktivitas, waktu, id_user)
    VALUES (NEWID(), @aktivitas, @waktu, @id_user);
END;
