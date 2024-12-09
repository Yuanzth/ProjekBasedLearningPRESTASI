<?php
// app/models/AdminModel.php

require_once '../config/Database.php'; // Memuat file Database.php

class AdminModel
{
    private $db;

    public function __construct()
    {
        // Membuat koneksi ke database
        $this->db = (new Database())->connect();
    }

    private function logError($message)
    {
        error_log((date('[Y-m-d H:i:s] ')) . $message . PHP_EOL, 3, '../logs/error.log');
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

    
    
}
