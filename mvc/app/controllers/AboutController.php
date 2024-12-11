<?php

class AboutController extends Controller{
    public function index($text = 'cihuyyy', $text2 = 'cihuyyy'){
        $data['judul'] = 'Tentang Kelompok 4 | Presma'; 
        $data['style'] = 'styleAbo.css';
        $this->view('layout/header', $data);
        $this->view('about/index');
        
    }
    public function page(){
        $this->view('about/page'); 
    }
}