<?php

// app/models/AdminModel.php

require_once '../config/Database.php';

class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    private function logError($message)
    {
        error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, '../logs/error.log');
    }

    private function executeStoredProcedure($procedure, $params = [])
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        $query = "{CALL $procedure($placeholders)}";
        $stmt = sqlsrv_prepare($this->db, $query, $params);

        if (!$stmt) {
            $this->logError(print_r(sqlsrv_errors(), true));
            throw new Exception("Error preparing stored procedure: " . $procedure);
        }

        if (!sqlsrv_execute($stmt)) {
            $this->logError(print_r(sqlsrv_errors(), true));
            throw new Exception("Error executing stored procedure: " . $procedure);
        }

        return $stmt;
    }

    public function getAdminByUserId($id_user)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAdminByUserId', [$id_user]);
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }
    // Menu: Manage User
    public function getAllUsers()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAllUsers');
            $users = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function createUser($username, $password, $privilege)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->executeStoredProcedure('sp_CreateUser', [$username, $hashedPassword, $privilege]);
            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function deleteUser($id_user)
    {
        try {
            $this->executeStoredProcedure('sp_DeleteUser', [$id_user]);
            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    // Menu: Manage Mahasiswa
    public function getAllMahasiswa()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAllMahasiswa');
            $mahasiswa = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $mahasiswa[] = $row;
            }
            return $mahasiswa;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function linkMahasiswaToUser($id_mahasiswa, $id_user)
    {
        try {
            $this->executeStoredProcedure('sp_LinkMahasiswaToUser', [$id_mahasiswa, $id_user]);
            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    // Menu: Manage Dosen
    public function getAllDosen()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAllDosen');
            $dosen = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $dosen[] = $row;
            }
            return $dosen;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    // Menu: Validasi Kompetisi
    public function getAllKompetisiForValidation()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetKompetisiForValidation');
            $kompetisi = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $kompetisi[] = $row;
            }
            return $kompetisi;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function validateKompetisi($id_kompetisi, $isValid, $notes = null)
    {
        try {
            $this->executeStoredProcedure('sp_ValidateKompetisi', [$id_kompetisi, $isValid, $notes]);
            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    // Menu: Lihat Prestasi
    public function getAllPrestasi()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAllPrestasi');
            $prestasi = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $prestasi[] = $row;
            }
            return $prestasi;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }
}