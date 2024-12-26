-- benar
USE db_prestasi;

SELECT * FROM tb_mahasiswa;

SELECT * FROM tb_user;

SELECT * FROM tb_admin;

SELECT * FROM tb_kompetisi;

SELECT * FROM tb_prestasi;

SELECT * FROM tb_dosen;

SELECT * FROM tb_kompetisi_backup;


-- salah
USE db_prestasi_nonakademik;

SELECT * FROM mahasiswa;

SELECT * FROM [user];

SELECT * FROM admin;

SELECT * FROM kompetisi;

SELECT * FROM prestasi_non_akademik;

SELECT * FROM dosen;

---------

EXEC sp_help 'kompetisi';

-- Untuk melihat struktur tabel mahasiswa
EXEC sp_help 'mahasiswa';

-- Untuk melihat struktur tabel dosen
EXEC sp_help 'dosen';

SELECT * 
FROM prestasi_non_akademik 
WHERE id_admin IS NULL AND id_kompetisi IS NOT NULL;

sp_help 'kompetisi';

SELECT * FROM sys.triggers WHERE name = 'trg_update_id_kompetisi';
