<div class="container d-flex align-items-center justify-content-center">
  <div class="col-12 col-lg-4 p-4 shadow">
    <form action="<?= BASE_URL; ?>auth/login" method="post">
      <h2>Masuk</h2>
      <img src="<?= BASE_URL; ?>public/assets/img/logo.png" alt="">
      <div class="input-group">
        <input type="text" name="username" class="bg-transparent" required>
        <label>Nama Pengguna</label>
        <i class="bi bi-person-fill"></i>
      </div>
      <div class="input-group">
        <input type="password" name="password" class="bg-transparent" required>
        <label>Kata Sandi</label>
        <i class="bi bi-lock-fill"></i>
      </div>
      <button type="submit" class="btn" name="Login" value="Proses">Masuk</button>
    </form>

    <!-- Tempat untuk menampilkan pesan error atau sukses -->
    <div id="loginMessage"></div>
    <!-- Tambahkan jQuery -->
  </div>
</div>