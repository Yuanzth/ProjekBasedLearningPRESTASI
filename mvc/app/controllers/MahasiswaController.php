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
            'style' => 'styleM.css',
            'mahasiswa' => $mahasiswa
        ];

        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('layout/footer');
    }

    public function semuaPrestasi()
    {
        $prestasiData = $this->mahasiswaModel->getAllPrestasi();
        
        $data = [
            'style' => 'stylePres.css',
            'prestasiData' => $prestasiData,
        ];

        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/semuaPrestasi', $data);
        $this->view('layout/footer');
    }

    public function prestasiSaya()
    {
        if (!isset($_SESSION['id_user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $id_user = $_SESSION['id_user'];
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByUserId($id_user);

        if (!$mahasiswa) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $prestasiData = $this->mahasiswaModel->getMyPrestasi($mahasiswa['id_mahasiswa']);

        $data = [
            'style' => 'stylePres.css',
            'prestasiData' => $prestasiData,
        ];

        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/prestasiSaya', $data);
        $this->view('layout/footer');
    }

    public function statusValidasi()
    {
        // Cek apakah session id_user ada
        if (!isset($_SESSION['id_user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil id_user dari session
        $id_user = $_SESSION['id_user'];

        // Ambil data mahasiswa berdasarkan id_user
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByUserId($id_user);

        // Cek jika data mahasiswa tidak ditemukan
        if (!$mahasiswa) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Ambil status validasi kompetisi dari model
        $prestasiData = $this->mahasiswaModel->getStatusValidasi($mahasiswa['id_mahasiswa']);

        // Siapkan data untuk view
        $data = [
            'style' => 'stylePres.css',  // Style untuk halaman status validasi (jika ada)
            'prestasiData' => $prestasiData,  // Kirimkan data prestasi
        ];

        // Render view header, halaman status validasi, dan footer
        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/statusValidasi', $data);
        $this->view('layout/footer');
    }


}
