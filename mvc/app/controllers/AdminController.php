<?php

require_once '../app/models/AdminModel.php'; 

class AdminController extends Controller{
    private $adminModel;

    public function __construct() {
        // Inisialisasi AdminModel
        $this->adminModel = new AdminModel();
    }

    // Dashboard Admin
    public function index() {
        
        // Periksa apakah session id_user tersedia
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
            // Redirect ke halaman login jika belum login atau bukan admin
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil id_user dari session
        $id_user = $_SESSION['id_user'];

        $admin = $this->adminModel->getAdminByUserId($id_user);
        $data = [
            'title' => 'Dashboard | Admin',
            'style' => 'styleAdmin.css',
            'admin' => $admin,
        ];
        $this->view('admin/headerAdmin', $data);
        $this->view('admin/dashboard', $data);
    }

    // Manage User - Menampilkan daftar pengguna
    public function manageUser() {
        $users = $this->adminModel->getAllUsers();
        include 'views/admin/manage_user.php';
    }

    // Tambah Pengguna
    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Menambah pengguna baru
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $privilege = $_POST['privilege'];

            $this->adminModel->createUser($username, $password, $privilege);
            header("Location: index.php?action=manageUser");
        } else {
            // Menampilkan form tambah pengguna
            include 'views/admin/add_user.php';
        }
    }

    // Hapus Pengguna
    public function deleteUser($id_user) {
        $this->adminModel->deleteUser($id_user);
        header("Location: index.php?action=manageUser");
    }

    // Manage Mahasiswa - Menampilkan daftar mahasiswa
    public function manageMahasiswa() {
        $mahasiswa = $this->adminModel->getAllMahasiswa();
        include 'views/admin/manage_mahasiswa.php';
    }

    // Manage Dosen - Menampilkan daftar dosen
    public function manageDosen() {
        $dosen = $this->adminModel->getAllDosen();
        include 'views/admin/manage_dosen.php';
    }

    // Validasi Kompetisi - Menampilkan daftar kompetisi yang belum tervalidasi
    public function validateCompetition() {
        $competitions = $this->adminModel->getKompetisiForValidation();
        include 'views/admin/validate_competition.php';
    }

    // Lihat Prestasi - Menampilkan daftar prestasi
    public function viewAchievements() {
        $achievements = $this->adminModel->getAllAchievements();
        include 'views/admin/view_achievements.php';
    }
}