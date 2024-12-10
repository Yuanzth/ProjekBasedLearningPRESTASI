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
    
    public function getKompetisiById($id_kompetisi)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetKompetisiById', [$id_kompetisi]);
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }

    public function getFileKompetisi($id_kompetisi)
    {
        // Eksekusi stored procedure untuk mengambil file
        $params = [$id_kompetisi];
        $stmt = $this->executeStoredProcedure('sp_GetFileKompetisi', $params);
    
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Ambil hasil query
        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
        return $data ?: false; // Kembalikan data atau false jika tidak ditemukan
    }
    
    public function updateKompetisiValidasi($id_kompetisi, $valid)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_UpdateKompetisiValidasi', [$id_kompetisi, $valid]);
            return $stmt;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }
    
    public function insertPrestasi($id_kompetisi, $id_admin)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_InsertPrestasi', [$id_kompetisi, $id_admin]);
            return $stmt;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function getKompetisiWithDetails()
    {
        $stmt = $this->executeStoredProcedure('sp_GetKompetisi');
        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getDetailKompetisi($id_kompetisi)
    {
        try {
            // Menjalankan stored procedure untuk mengambil detail kompetisi
            $stmt = $this->executeStoredProcedure('sp_GetDetailKompetisi', [$id_kompetisi]);
            
            // Mengambil hasil query sebagai array asosiatif
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            
            // Mengembalikan hasil jika ada, atau null jika tidak ada
            return $result ?: null;
        } catch (Exception $e) {
            // Menangani error dan mencatat log error
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
    // Belum 
    public function getUnvalidatedKompetisi()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetUnvalidatedKompetisi');
            $data = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    // sudah 


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