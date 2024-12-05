<div class="card w-50 mx-auto">
    <div class="card-body">
        <h5 class="card-title text-center mb-5">Register</h5>
        <form id="registerForm" method="POST" action="<?= BASE_URL; ?>auth/register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="privilege">Role</label>
                <select name="privilege" id="privilege" class="form-control" required>
                    <option value="">-- SELECT ROLE --</option>
                    <option value="M">Mahasiswa</option>
                    <option value="A">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <!-- Tempat untuk menampilkan pesan error atau sukses -->
        <div id="registerMessage"></div>
    </div>
</div>