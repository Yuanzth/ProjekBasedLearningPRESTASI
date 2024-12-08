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

    public function getAllPrestasi() {
        try {
            $query = "SELECT * FROM vw_AllPrestasi";
            $stmt = sqlsrv_query($this->db, $query);
    
            if (!$stmt) {
                $this->logError(print_r(sqlsrv_errors(), true));
                throw new Exception("Error executing query: vw_AllPrestasi");
            }
    
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
    
    public function getMyPrestasi($id_mahasiswa) {
        try {
            // Mengambil data dari vw_MyPrestasi dengan filter id_mahasiswa
            $query = "SELECT * FROM vw_MyPrestasi WHERE id_mahasiswa = ?";
            $stmt = sqlsrv_prepare($this->db, $query, [$id_mahasiswa]);
    
            if (!$stmt) {
                $this->logError(print_r(sqlsrv_errors(), true));
                throw new Exception("Error preparing query: vw_MyPrestasi");
            }
    
            if (!sqlsrv_execute($stmt)) {
                $this->logError(print_r(sqlsrv_errors(), true));
                throw new Exception("Error executing query: vw_MyPrestasi");
            }
    
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
    public function ajukanKompetisi($judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, 
                                $tanggal_kompetisi, $file_surat_tugas, $file_sertifikat, 
                                $role, $id_mahasiswa, $id_dosen)
    {
        try {
            // Convert file surat tugas dan sertifikat menjadi base64 string
            $file_surat_tugas_data = base64_encode(file_get_contents($file_surat_tugas['tmp_name']));
            $file_sertifikat_data = base64_encode(file_get_contents($file_sertifikat['tmp_name']));
            
            // Eksekusi stored procedure untuk memasukkan data
            $params = [
                $judul_kompetisi,
                $tingkat_kompetisi,
                $tempat_kompetisi,
                $tanggal_kompetisi,
                $file_surat_tugas_data,  // Kirimkan base64 string
                $file_sertifikat_data,   // Kirimkan base64 string
                $role,
                $id_mahasiswa,
                $id_dosen
            ];
            
            // Pastikan executeStoredProcedure berjalan dengan benar
            $stmt = $this->executeStoredProcedure('sp_InsertKompetisi', $params);
            
            if (!$stmt) {
                throw new Exception("Error executing stored procedure: sp_InsertKompetisi");
            }

            return true;  // Return true jika berhasil
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function getKompetisiBelumValidasi($id_mahasiswa)
    {
        try {
            // Query untuk mengambil kompetisi mahasiswa yang status validasinya masih 'N'
            $query = "SELECT * FROM tb_kompetisi WHERE id_mahasiswa = ? AND valid = 'N'";
            $stmt = sqlsrv_prepare($this->db, $query, [$id_mahasiswa]);

            if (!$stmt) {
                $this->logError(print_r(sqlsrv_errors(), true));
                throw new Exception("Error preparing query: getKompetisiBelumValidasi");
            }

            if (!sqlsrv_execute($stmt)) {
                $this->logError(print_r(sqlsrv_errors(), true));
                throw new Exception("Error executing query: getKompetisiBelumValidasi");
            }

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
    public function getDosen()
    {
        $stmt = $this->executeStoredProcedure('sp_GetAllDosen');
        if (!$stmt) {
            $this->logError(print_r(sqlsrv_errors(), true));
            throw new Exception("Error executing query: getDosen");
        }

        $dosen = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $dosen[] = $row;
        }

        return $dosen;
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

    public function updateKompetisi(
        $id_kompetisi,
        $judul_kompetisi,
        $tingkat_kompetisi,
        $tempat_kompetisi,
        $tanggal_kompetisi,
        $file_surat_tugas,
        $file_sertifikat,
        $role,
        $id_dosen
    ) {
        $params = [
            $id_kompetisi,
            $judul_kompetisi,
            $tingkat_kompetisi,
            $tempat_kompetisi,
            $tanggal_kompetisi,
            $file_surat_tugas,
            $file_sertifikat,
            $role,
            $id_dosen
        ];
    
        $stmt = $this->executeStoredProcedure('sp_UpdateKompetisi', $params);
    
        return $stmt ? true : false;
    }
    
}
