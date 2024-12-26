

USE db_prestasi;

-- Trigger ini akan mengatur ulang id_kompetisi
DROP TRIGGER trg_AfterDelete_Reseed;
CREATE TRIGGER trg_AfterDelete_Reseed
ON tb_kompetisi
AFTER DELETE
AS
BEGIN
    DECLARE @max_id INT;
    DECLARE @next_id INT;

    -- Mendapatkan ID terbesar yang ada di tabel setelah penghapusan
    SELECT @max_id = MAX(id_kompetisi) FROM tb_kompetisi;

    -- Jika ada ID yang hilang (kosong), kita akan menyesuaikan reseed
    WITH MissingIDs AS (
        SELECT id_kompetisi + 1 AS missing_id
        FROM tb_kompetisi
        WHERE NOT EXISTS (
            SELECT 1 FROM tb_kompetisi t2 WHERE t2.id_kompetisi = tb_kompetisi.id_kompetisi + 1
        )
    )
    -- Ambil ID yang hilang pertama
    SELECT @next_id = MIN(missing_id) FROM MissingIDs;

    -- Jika ID yang hilang ditemukan, kita reset ID untuk ID yang hilang
    IF @next_id IS NOT NULL
    BEGIN
        -- Melakukan reseed untuk ID yang hilang
        DBCC CHECKIDENT ('tb_kompetisi', RESEED, @next_id);
    END
    ELSE
    BEGIN
        -- Jika tidak ada ID yang hilang, reseed ke ID terbesar yang ada
        DBCC CHECKIDENT ('tb_kompetisi', RESEED, @max_id);
    END
END;


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
    DECLARE @next_id INT;

    SET @file_surat_tugas_bin = CAST('' AS XML).value('xs:base64Binary(sql:variable("@file_surat_tugas"))', 'VARBINARY(MAX)');
    SET @file_sertifikat_bin = CAST('' AS XML).value('xs:base64Binary(sql:variable("@file_sertifikat"))', 'VARBINARY(MAX)');

    -- Mencari ID yang kosong pertama
    SELECT @next_id = MIN(id_kompetisi)
    FROM tb_kompetisi
    WHERE id_kompetisi NOT IN (SELECT id_kompetisi FROM tb_kompetisi);

    -- Jika ID kosong ditemukan, gunakan ID tersebut
    IF @next_id IS NOT NULL
    BEGIN
        -- Memasukkan data ke dalam tabel dengan ID kosong
        INSERT INTO tb_kompetisi (id_kompetisi, judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
                                  file_surat_tugas, file_sertifikat, role, id_mahasiswa, id_dosen)
        VALUES (@next_id, @judul_kompetisi, @tingkat_kompetisi, @tempat_kompetisi, @tanggal_kompetisi, 
                @file_surat_tugas_bin, @file_sertifikat_bin, @role, @id_mahasiswa, @id_dosen);
    END
    ELSE
    BEGIN
        -- Jika tidak ada ID kosong, masukkan data ke ID terbesar yang ada
        INSERT INTO tb_kompetisi (judul_kompetisi, tingkat_kompetisi, tempat_kompetisi, tanggal_kompetisi, 
                                  file_surat_tugas, file_sertifikat, role, id_mahasiswa, id_dosen)
        VALUES (@judul_kompetisi, @tingkat_kompetisi, @tempat_kompetisi, @tanggal_kompetisi, 
                @file_surat_tugas_bin, @file_sertifikat_bin, @role, @id_mahasiswa, @id_dosen);
    END
END;

-- Trigger untuk membuat backup data sebelum penghapusan
DROP TRIGGER trg_backup_tb_kompetisi;
CREATE TRIGGER trg_backup_tb_kompetisi
ON tb_kompetisi
INSTEAD OF DELETE
AS
BEGIN
    -- Mulai blok transaksi untuk memastikan atomisitas
    BEGIN TRANSACTION;

    BEGIN TRY
        -- Masukkan data yang akan dihapus ke tabel backup
        INSERT INTO tb_kompetisi_backup (
            id_kompetisi,          
            judul_kompetisi,       
            tingkat_kompetisi,     
            tempat_kompetisi,      
            tanggal_kompetisi,     
            file_surat_tugas,      
            file_sertifikat,       
            role,                  
            id_mahasiswa,          
            id_dosen,              
            valid,                 
            deleted_at             
        )
        SELECT
            id_kompetisi,
            judul_kompetisi,
            tingkat_kompetisi,
            tempat_kompetisi,
            tanggal_kompetisi,
            file_surat_tugas,
            file_sertifikat,
            role,
            id_mahasiswa,
            id_dosen,
            valid,
            GETDATE()              -- Timestamp untuk mencatat waktu penghapusan
        FROM DELETED;

        -- Lanjutkan penghapusan data dari tabel utama
        DELETE FROM tb_kompetisi
        WHERE id_kompetisi IN (SELECT id_kompetisi FROM DELETED);

        -- Komit transaksi jika semuanya berhasil
        COMMIT TRANSACTION;
    END TRY
    BEGIN CATCH
        -- Rollback transaksi jika terjadi kesalahan
        ROLLBACK TRANSACTION;

        -- Menampilkan pesan error
        THROW;
    END CATCH;
END;