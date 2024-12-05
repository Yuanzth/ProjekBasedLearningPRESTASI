<?php
// public/index.php

// Memuat file App.php
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../config/config.php';
require_once '../config/database.php';

// Menjalankan aplikasi
$app = new App();