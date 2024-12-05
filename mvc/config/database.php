<?php
class Database
{
    private $serverName = "LAPTOP-8EBEE6AE"; // Nama server SQL Server
    private $connectionOptions = [
        "Database" => "db_prestasi",   // Nama database
        "Uid" => "",                 // Username SQL Server
        "PWD" => "",                // Password SQL Server
    ];
    public $conn;

    public function connect()
    {
        $this->conn = sqlsrv_connect($this->serverName, $this->connectionOptions);

        if ($this->conn === false) {
            die(print_r(sqlsrv_errors(), true)); // Debug jika terjadi error
        }

        return $this->conn;
    }
}
// Cek Koneksi ke Database
$db = new Database();
$conn = $db->connect();

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Debug jika terjadi error
} else {
    // echo "Koneksi Berhasil";
}
