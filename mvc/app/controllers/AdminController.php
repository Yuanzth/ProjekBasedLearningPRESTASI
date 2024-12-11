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
        $kompetisi = $this->adminModel->getKompetisiWithDetails();
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
        $kompetisi = $this->adminModel->getDetailKompetisi($id_kompetisi);
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
        // Periksa apakah session id_user tersedia
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
            // Redirect ke halaman login jika belum login atau bukan admin
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil data semua pengguna
        $users = $this->adminModel->getAllUsers();
        $data = [
            'title' => 'Manage User',
            'style' => 'styleAdmin.css',
            'users' => $users,
        ];

        // Tampilkan view
        $this->view('admin/headerAdmin', $data);
        $this->view('admin/manageUser', $data);
    }



    // Tambah Pengguna
    public function addUser()
    {
        // Periksa apakah form telah dikirim
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $privilege = $_POST['privilege']; // Ambil huruf pertama privilege

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if ($this->adminModel->isUsernameExists($username)) {
                $data = ['error' => 'Username sudah digunakan.'];
                $this->view('admin/error', $data);
                return;
            }

            if ($this->adminModel->register($username, $hashedPassword, $privilege)) {
                header('Location: ' . BASE_URL . 'admin/manageUser');
                exit;
            } else {
                $data = ['error' => 'Gagal menambahkan user'];
                $this->view('admin/error', $data);
            }
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
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
    
        $mahasiswa = $this->adminModel->getAllMahasiswa();
        $data = [
            'title' => 'Manage Mahasiswa | Admin',
            'style' => 'styleAdmin.css',
            'mahasiswa' => $mahasiswa
        ];
    
        $this->view('admin/headerAdmin', $data);
        $this->view('admin/manageMahasiswa', $data);
    }
    
    // Tambah Mahasiswa
    public function addMahasiswa()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'NIM' => $_POST['nim'],
            'nama' => $_POST['nama_mahasiswa'],
            'program_studi' => $_POST['program_studi'],
            'email' => $_POST['email_mahasiswa'],
            'no_telp' => $_POST['no_telp_mahasiswa'],
            'semester' => 1, // Set default semester
            'id_user' => $_POST['id_user'] ?? null,
            'id_admin' => $_SESSION['id_admin']
        ];

        if ($this->adminModel->addMahasiswa($data)) {
            header('Location: ' . BASE_URL . 'admin/manageMahasiswa');
        } else {
            die('Gagal menambahkan mahasiswa.');
        }
    }
}


    // Manage Dosen - Menampilkan daftar dosen
    public function manageDosen()
    {
        $dosen = $this->adminModel->getAllDosen();
        include 'views/admin/manage_dosen.php';
    }


    // Lihat Prestasi - Menampilkan daftar prestasi
    public function lihatPrestasi()
{
    // Periksa apakah session id_user tersedia
    if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'A') {
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }

    // Ambil data prestasi dari model
    $prestasi = $this->adminModel->getAllPrestasi();

    $data = [
        'title' => 'Lihat Prestasi | Admin',
        'style' => 'styleAdmin.css',
        'prestasi' => $prestasi,
    ];
    $this->view('admin/headerAdmin', $data);
    $this->view('admin/lihatPrestasi', $data);
}

}