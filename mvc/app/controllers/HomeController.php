<?php
require_once '../app/models/MahasiswaModel.php';

class HomeController extends Controller
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
        $data['judul'] = 'Beranda Utama | Presma'; 
        $data['style'] = 'styleI.css';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }

    public function semuaPrestasi()
    {
        $prestasiData = $this->mahasiswaModel->getAllPrestasi();

        $data = [
            'judul' => 'Semua Prestasi | Presma',
            'style' => 'styleM.css',
            'prestasiData' => $prestasiData,
        ];

        $this->view('layout/header', $data);
        $this->view('home/semuaPrestasi', $data);
        $this->view('layout/footer');
    }
}
