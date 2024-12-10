<?php

require_once '../app/models/AdminModel.php';

class AdminController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        // Inisialisasi AdminModel
        $this->adminModel = new AdminModel();
    }

    // Dashboard Admin
    public function index()
    {

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

    // Validasi Kompetisi - Menampilkan daftar kompetisi yang belum tervalidasi
    public function validasiKompetisi()
    {
        // Cek apakah admin sudah login
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil kompetisi yang belum divalidasi
        $kompetisi = $this->adminModel->getUnvalidatedKompetisi();
        $data = [
            'title' => 'Validasi Kompetisi',
            'style' => 'styleAdmin.css',
            'kompetisi' => $kompetisi,
        ];

        $this->view('admin/headerAdmin', $data);
        $this->view('admin/validasiKompetisi', $data);
    }

    public function setValidasiKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_kompetisi = $_POST['id_kompetisi'];
            $valid = $_POST['valid'];
            $id_admin = $_SESSION['id_admin']; // Ambil id_admin dari session
    
            // Update validasi kompetisi
            $this->adminModel->updateKompetisiValidasi($id_kompetisi, $valid);
    
            if ($valid === 'Y') {
                // Masukkan ke tb_prestasi menggunakan stored procedure
                $this->adminModel->insertPrestasi($id_kompetisi, $id_admin);
            }
    
            header('Location: ' . BASE_URL . 'admin/validasiKompetisi');
        }
    }
    
    public function detailKompetisi($id_kompetisi)
    {
        // Cek apakah admin sudah login
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil data detail kompetisi
        $kompetisi = $this->adminModel->getKompetisiById($id_kompetisi);
        if (!$kompetisi) {
            die("Kompetisi tidak ditemukan.");
        }

        $data = [
            'title' => 'Detail Kompetisi',
            'style' => 'styleAdmin.css',
            'kompetisi' => $kompetisi,
        ];

        $this->view('admin/headerAdmin', $data);
        $this->view('admin/detailKompetisi', $data);
    }

    public function previewFile($id_kompetisi, $file_type)
    {
        // Validasi parameter 'file'
        if (!in_array($file_type, ['surat_tugas', 'sertifikat'])) {
            die("Parameter 'file' tidak valid.");
        }
    
        // Ambil file dari database
        $file = $this->adminModel->getFileKompetisi($id_kompetisi);
    
        if (!$file) {
            die("Data kompetisi tidak ditemukan.");
        }
    
        // Tentukan file yang akan ditampilkan
        $file_data = null;
        $file_name = null;
    
        if ($file_type === 'surat_tugas') {
            $file_data = $file['file_surat_tugas'];
            $file_name = "surat_tugas_$id_kompetisi.pdf";
        } elseif ($file_type === 'sertifikat') {
            $file_data = $file['file_sertifikat'];
            $file_name = "sertifikat_$id_kompetisi.pdf";
        }
    
        if ($file_data === null) {
            die("File tidak ditemukan.");
        }
    
        // Kirim file ke browser untuk pratinjau
        header("Content-Disposition: inline; filename=$file_name");
        header("Content-Type: application/pdf");
        echo $file_data;
        exit;
    }
    // Manage User - Menampilkan daftar pengguna
    public function manageUser()
    {
        $users = $this->adminModel->getAllUsers();
        include 'views/admin/manageUser.php';
    }

    // Tambah Pengguna
    public function addUser()
    {
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
    public function deleteUser($id_user)
    {
        $this->adminModel->deleteUser($id_user);
        header("Location: index.php?action=manageUser");
    }

    // Manage Mahasiswa - Menampilkan daftar mahasiswa
    public function manageMahasiswa()
    {
        $mahasiswa = $this->adminModel->getAllMahasiswa();
        include 'views/admin/manage_mahasiswa.php';
    }

    // Manage Dosen - Menampilkan daftar dosen
    public function manageDosen()
    {
        $dosen = $this->adminModel->getAllDosen();
        include 'views/admin/manage_dosen.php';
    }


    // Lihat Prestasi - Menampilkan daftar prestasi
    public function viewAchievements()
    {
        $achievements = $this->adminModel->getAllAchievements();
        include 'views/admin/view_achievements.php';
    }
}