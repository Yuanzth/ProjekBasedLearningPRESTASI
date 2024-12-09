<?php

require_once '../app/models/AdminModel.php'; 

class AdminController {
    private $adminmodel;

    public function __construct() {
        $this->adminmodel = new AdminModel();
    }

    // Method index untuk menampilkan view dashboard admin
}