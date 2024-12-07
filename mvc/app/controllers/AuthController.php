<?php
// app/controllers/AuthController.php

require_once '../app/models/UserModel.php'; // Memuat model

class AuthController extends Controller
{
    public function index()
    {
        // Tampilkan halaman login sebagai halaman default
        $data['judul']='Masuk | Presma'; 
        $data['style']='style.css';
        $this->view('layout/header', $data);
        $this->view('auth/login');
        $this->view('layout/footer');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel(); // Membuat instance UserModel

            $user = $userModel->login($_POST['username'], $_POST['password']);
            
            if ($user) {
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['privilege'] = $user['privilege']; // Menyimpan privilege di session
                // Redirect berdasarkan privilege
                if ($_SESSION['privilege'] === "A") {
                    header('Location: ' . BASE_URL . 'admin/dashboard'); // Arahkan ke halaman dashboard admin
                } elseif ($_SESSION['privilege'] === "M") {
                    echo "<script>
                        alert('Berhasil login.');
                        window.location.href = '" . BASE_URL . "mahasiswa/index';
                    </script>";
                    // header('Location: ' . BASE_URL . 'mahasiswa/index'); // Arahkan ke halaman dashboard mahasiswa
                } else {
                    echo "privilege tidak valid.";
                }
                exit();
            } else {
                echo "<script>
                        alert('Username atau password salah.');
                        window.location.href = '" . BASE_URL . "auth/login';
                    </script>";
            }
        } else {
            AuthController::index(); // Menampilkan halaman login
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $privilege = $_POST['privilege'] ?? '';

            if (empty($username) || empty($password) || empty($privilege)) {
                echo "All fields are required.";
                exit(); // Hentikan eksekusi jika ada input kosong
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Memuat model
            $userModel = new UserModel();

            // Cek apakah username sudah ada
            if ($userModel->isUsernameExists($username)) {
                // Tampilkan alert jika username sudah ada
                echo "<script>alert('Username already exists.');</script>";
            } else {
                // Simpan pengguna baru ke database
                $result = $userModel->register($username, $hashedPassword, $privilege);

                if ($result) {
                    // Tampilkan pesan sukses dan arahkan ke halaman login
                    echo "<script>
                        alert('Registration successful.');
                        window.location.href = '" . BASE_URL . "auth/login';
                    </script>";
                    exit();
                } else {
                    // Tampilkan pesan gagal dalam alert
                    echo "<script>alert('Registration failed. Please try again.');</script>";
                }
            }
        }
            $data['judul']='Daftar | Presma'; 
            $data['style']='style.css';
            $this->view('layout/header', $data);
            $this->view('auth/register');
            $this->view('layout/footer');
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'auth/login'); // Arahkan kembali ke halaman login setelah logout
        exit();
    }
}