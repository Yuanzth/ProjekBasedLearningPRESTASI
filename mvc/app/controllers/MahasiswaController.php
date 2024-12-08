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
            'style' => 'styleM.css',
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
            'style' => 'styleM.css',
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
            'style' => 'styleM.css',  // Style untuk halaman status validasi (jika ada)
            'prestasiData' => $prestasiData,  // Kirimkan data prestasi
        ];

        // Render view header, halaman status validasi, dan footer
        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/statusValidasi', $data);
        $this->view('layout/footer');
    }

    public function ajukanKompetisi()
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

        // Ambil data kompetisi yang belum divalidasi (valid = 'N')
        $kompetisi = $this->mahasiswaModel->getKompetisiBelumValidasi($mahasiswa['id_mahasiswa']);
        $dosen = $this->mahasiswaModel->getDosen();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul_kompetisi = $_POST['judul_kompetisi'];
            $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
            $tempat_kompetisi = $_POST['tempat_kompetisi'];
            $tanggal_kompetisi = $_POST['tanggal_kompetisi'];
            $file_surat_tugas = $_FILES['file_surat_tugas'];
            $file_sertifikat = $_FILES['file_sertifikat'];
            $role = $_POST['role'];
            $id_mahasiswa = $mahasiswa['id_mahasiswa'];
            $id_dosen = $_POST['id_dosen'];  // Mengambil dari form (atau bisa dipilih dari daftar dosen)

            $result = $this->mahasiswaModel->ajukanKompetisi($judul_kompetisi, $tingkat_kompetisi, $tempat_kompetisi, 
                                                            $tanggal_kompetisi, $file_surat_tugas, $file_sertifikat, 
                                                            $role, $id_mahasiswa, $id_dosen);

            if ($result) {
                // Redirect ke halaman pengajuan sukses atau halaman daftar kompetisi
                header('Location: ' . BASE_URL . 'mahasiswa/ajukanKompetisi');
                exit;
            } else {
                // Tampilkan error jika gagal
                $data = ['error' => 'Pengajuan kompetisi gagal!'];
                $data = [
                    'style' => 'styleAjukan.css',
                    'kompetisi' => $kompetisi,  // Kirimkan data kompetisi yang belum divalidasi
                    'dosen' => $dosen  // Kirimkan data dosen
                ];
                $this->view('mahasiswa/headerMhs', $data);
                $this->view('mahasiswa/pengajuan', $data);
                $this->view('layout/footer');
            }
        } else {
            // Siapkan data untuk view (termasuk kompetisi yang belum divalidasi)
            $data = [
                'style' => 'styleAjukan.css',
                'kompetisi' => $kompetisi,  // Kirimkan data kompetisi yang belum divalidasi
                'dosen' => $dosen  // Kirimkan data dosen
            ];
            $this->view('mahasiswa/headerMhs', $data);
            $this->view('mahasiswa/pengajuan', $data);
            $this->view('layout/footer');
        }
    }

    public function previewFile($id_kompetisi, $file_type)
    {
        // Validasi parameter 'file'
        if (!in_array($file_type, ['surat_tugas', 'sertifikat'])) {
            die("Parameter 'file' tidak valid.");
        }
    
        // Ambil file dari database
        $file = $this->mahasiswaModel->getFileKompetisi($id_kompetisi);
    
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

    public function updateKompetisi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_kompetisi = $_POST['id_kompetisi'];
            $judul_kompetisi = $_POST['judul_kompetisi'];
            $tingkat_kompetisi = $_POST['tingkat_kompetisi'];
            $tempat_kompetisi = $_POST['tempat_kompetisi'];
            $tanggal_kompetisi = $_POST['tanggal_kompetisi'];
            $role = $_POST['role'];
            $id_dosen = $_POST['id_dosen'];
    
            $file_surat_tugas = !empty($_FILES['file_surat_tugas']['tmp_name']) 
                                ? file_get_contents($_FILES['file_surat_tugas']['tmp_name']) 
                                : null;
    
            $file_sertifikat = !empty($_FILES['file_sertifikat']['tmp_name']) 
                                ? file_get_contents($_FILES['file_sertifikat']['tmp_name']) 
                                : null;
    
            $result = $this->mahasiswaModel->updateKompetisi(
                $id_kompetisi,
                $judul_kompetisi,
                $tingkat_kompetisi,
                $tempat_kompetisi,
                $tanggal_kompetisi,
                $file_surat_tugas,
                $file_sertifikat,
                $role,
                $id_dosen
            );
    
            if ($result) {
                header('Location: ' . BASE_URL . 'mahasiswa/ajukanKompetisi');
                exit;
            } else {
                echo "Gagal mengupdate kompetisi.";
            }
        }
    }
    public function editKompetisi($id_kompetisi)
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
    
        // Ambil data kompetisi berdasarkan ID
        $kompetisi = $this->mahasiswaModel->getFileKompetisi($id_kompetisi);
        $dosen = $this->mahasiswaModel->getDosen(); // Ambil data dosen untuk dropdown
    
        if (!$kompetisi) {
            echo "Data kompetisi tidak ditemukan.";
            exit;
        }
    
        // Siapkan data untuk view
        $data = [
            'style' => 'styleAjukan.css',
            'kompetisi' => $kompetisi,
            'dosen' => $dosen
        ];
        $this->view('mahasiswa/headerMhs', $data);
        $this->view('mahasiswa/editKompetisi', $data);
        $this->view('layout/footer');
    }
    
}
