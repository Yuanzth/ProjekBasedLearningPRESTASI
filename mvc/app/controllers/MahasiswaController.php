<?php

require_once '../app/models/MahasiswaModel.php';

class MahasiswaController extends Controller
{
    private $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();

        // Header mencegah caching
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    public function index()
    {
        // Periksa apakah session id_user tersedia
        if (!isset($_SESSION['id_user']) || $_SESSION['privilege'] !== 'M') {
            // Redirect ke halaman login jika belum login atau bukan mahasiswa
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil id_user dari session
        $id_user = $_SESSION['id_user'];

        // Ambil data mahasiswa berdasarkan ID User
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByUserId($id_user);

        // Jika data mahasiswa tidak ditemukan, beri nilai default
        if (!$mahasiswa) {
            $mahasiswa = [
                'nama' => 'Tidak Diketahui',
                'program_studi' => 'Tidak Diketahui'
            ];
        }

        // Kirim data ke view
        $data = [
            'style' => 'styleMhs.css',
            'mahasiswa' => $mahasiswa
        ];

        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('layout/footer');
    }
}
