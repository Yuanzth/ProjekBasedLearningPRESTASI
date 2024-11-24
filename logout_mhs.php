<?php
session_start();

// Menghancurkan sesi
session_unset();
session_destroy();

// Mengarahkan ke halaman login setelah logout
header("Location: login_mhs.php");
exit();
?>
