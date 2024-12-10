<main>
    <div class="container-fluid my-4">
        <h3>Manage User</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Privilege</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_user']); ?></td>
                        <td><?= htmlspecialchars($user['username']); ?></td>
                        <td><?= htmlspecialchars($user['privilege'] === 'A' ? 'Admin' : 'Mahasiswa'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Modal Tambah User -->
        <div class="row my-3">
            <div class="col-5">
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambahkan User</button>
            </div>
        </div>

        <!-- Modal Tambah User -->
        <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Form Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= BASE_URL; ?>admin/addUser" method="POST">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Username</span>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Password</span>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Privilege</label>
                                <select class="form-select" name="privilege" required>
                                    <option value="admin">Admin</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambahkan User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
