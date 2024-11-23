<?php

//Buat nama serverName nya itu pake nama server yang windows authentication kalian, 
//tapi nanti jangan dicommit buat perubahan nama laptop nya

$serverName = "LAPTOP-8EBEE6AE"; // serverName\instanceName
$connectionInfo = array("Database" => "db_prestasi_nonakademik"); // Ganti nama database di sini
$conn = sqlsrv_connect($serverName, $connectionInfo);

// if ($conn) {
//     echo "Connection established.<br />";
// } else {
//     echo "Connection could not be established.<br />";
//     die(print_r(sqlsrv_errors(), true));
// }
?>