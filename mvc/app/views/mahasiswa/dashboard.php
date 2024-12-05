  <!-- Konten -->
  <div class="content" id="content">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark">
          <button class="btn btn-light" id="toggle-sidebar">☰</button>
          <a class="navbar-brand ml-3" href="#">Dashboard Mahasiswa</a>
          <!-- Profil Dropdown -->
          <div class="ml-auto">
              <div class="btn-group">
                  <button type="button" class="btn btn-dark profile-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- Menggunakan gambar profil online, bisa diganti dengan URL yang sesuai -->
                      <img src="https://www.w3schools.com/w3images/avatar2.png" alt="User Profile">
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">My Profile</a>
                      <a class="dropdown-item" href="logout_mhs.php">Logout</a>
                  </div>
              </div>
          </div>
      </nav>

      <!-- Selamat Datang -->
      <div class="container mt-4">
          <p>Ini Dashboard Mahasiswa Anda. Program Studi: </p>
      </div>

      <!-- Menu di Tengah -->
      <div class="menu-container">
          <a href="tambah_kompetisi.php" class="menu-item menu-tambah">
              Tambah Kompetisi
              <p style="font-size: 12px; margin-top: 10px;">Menu untuk menambahkan record kompetisi yang akan divalidasi admin nantinya</p>
          </a>
          <a href="cek_status_validasi.php" class="menu-item menu-cek-status">
              Cek Status Validasi
              <p style="font-size: 12px; margin-top: 10px;">Menu untuk mengecek status validasi kompetisi yang sudah/belum/tidak divalidasi admin</p>
          </a>
          <a href="prestasi_saya.php" class="menu-item menu-prestasi-saya">
              Prestasi Saya
              <p style="font-size: 12px; margin-top: 10px;">Menu untuk mengecek prestasi yang sudah saya capai</p>
          </a>
          <a href="prestasi_semua.php" class="menu-item menu-prestasi-semua">
              Prestasi Semua
              <p style="font-size: 12px; margin-top: 10px;">Menu untuk melihat prestasi dari keseluruhan mahasiswa</p>
          </a>
      </div>
  </div>