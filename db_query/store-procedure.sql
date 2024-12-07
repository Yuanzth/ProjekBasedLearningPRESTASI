-- stored proceudre
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
DROP PROCEDURE sp_GetUserByUsername;
CREATE PROCEDURE sp_GetUserByUsername
    @Username VARCHAR(30)
AS
BEGIN
    SELECT username, password, privilege
    FROM tb_user 
    WHERE username = @Username;
END;

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