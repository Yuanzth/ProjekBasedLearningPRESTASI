<?php

// app/models/MahasiswaModel.php

require_once '../config/Database.php';

class MahasiswaModel
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

    public function getMahasiswaByUserId($id_user)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetMahasiswaByUserId', [$id_user]);
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return null;
        }
    }

    public function getAllPrestasi()
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetAllPrestasi');
            $results = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    public function getMyPrestasi($id_mahasiswa)
    {
        try {
            $stmt = $this->executeStoredProcedure('sp_GetMyPrestasi', [$id_mahasiswa]);
            $results = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return [];
        }
    }

    // Fungsi untuk mendapatkan status validasi kompetisi
    public function getStatusValidasi($id_mahasiswa)
{
    try {
        // Panggil stored procedure untuk mendapatkan status validasi
        $stmt = $this->executeStoredProcedure('sp_GetStatusValidasi', [$id_mahasiswa]);

        $results = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
        }

        return $results;
    } catch (Exception $e) {
        $this->logError($e->getMessage());
        return [];
    }
}
}
