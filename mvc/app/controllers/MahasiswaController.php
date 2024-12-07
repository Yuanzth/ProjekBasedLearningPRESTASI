<?php

require_once '../app/models/UserModel.php'; // Memuat model

class MahasiswaController extends Controller
{
    public function index()
    {
        $data['style'] = 'styleMhs.css';
        $this->view('mahasiswa/headerMhs' , $data);
        $this->view('mahasiswa/index');
        $this->view('layout/footer');
    }
}