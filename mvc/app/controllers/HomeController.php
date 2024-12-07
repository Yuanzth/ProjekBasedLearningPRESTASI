<?php

class HomeController extends Controller{
    public function index()
    {
        $data['judul']='Dashboard | Presma'; 
        $data['style']='styleI.css';
        $this->view('layout/header', $data);
        $this->view('home/index');
        $this->view('layout/footer');
    }

}