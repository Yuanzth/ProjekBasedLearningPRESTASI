<?php
// app/core/App.php 

class App
{
    protected $controller = 'HomeController'; // Default controller
    protected $method = 'index'; // Default method
    protected $params = [];

    public function __construct()
    {
        session_start();
        $url = $this->parseUrl();
        // Cek apakah ada elemen di dalam URL, jika ada, tentukan controller dan method
        if (!empty($url)) {
            // Cek apakah controller yang diminta ada
            $controllerFile = __DIR__ . '/../controllers/' . ucfirst($url[0]) . 'Controller.php';
            if (file_exists($controllerFile)) {
                $this->controller = ucfirst($url[0]) . 'Controller'; // Menambahkan 'Controller' pada nama class
                unset($url[0]);
            } else {
                $this->controller = 'HomeController'; // Default controller
            }
        }

        // Memuat controller yang dipilih
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $controllerObj = new $this->controller();

        // Cek apakah method yang diminta ada di dalam controller
        if (isset($url[1]) && method_exists($controllerObj, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Set parameters jika ada
        $this->params = !empty($url) ? array_values($url) : [];

        // Eksekusi method controller dengan parameter jika ada
        call_user_func_array([$controllerObj, $this->method], $this->params);

    }

    // Fungsi untuk memparsing URL
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            // Menghapus karakter yang tidak diinginkan pada URL
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}