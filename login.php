<?php
session_start();
$role = isset($_GET['role']) ? $_GET['role'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: Implementasikan logika autentikasi yang aman di sini
    // Untuk sementara, kita gunakan logika sederhana

    if ($role == 'mahasiswa') {
        // Logika login mahasiswa
        if ($username == 'mahasiswa' && $password == 'password') {
            $_SESSION['user_role'] = 'mahasiswa';
            $_SESSION['username'] = $username;
            header("Location: dashboard_mahasiswa.php");
            exit();
        }
    } elseif ($role == 'admin') {
        // Logika login admin
        if ($username == 'admin' && $password == 'adminpass') {
            $_SESSION['user_role'] = 'admin';
            $_SESSION['username'] = $username;
            header("Location: dashboard_admin.php");
            exit();
        }
    }

    $error = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo ucfirst($role); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-form input {
            margin: 10px 0;
            padding: 8px;
            width: 200px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login <?php echo ucfirst($role); ?></h1>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form class="login-form" method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login" class="button">
        </form>
        <p><a href="index.php">Kembali ke Halaman Utama</a></p>
    </div>
</body>
</html>