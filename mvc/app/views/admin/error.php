<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>public/assets/css/style.css"> <!-- Sesuaikan dengan style Anda -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center" role="alert">
                    <h4 class="alert-heading">Terjadi Kesalahan</h4>
                    <p><?= isset($data['error']) ? htmlspecialchars($data['error']) : 'Kesalahan tidak diketahui.'; ?></p>
                    <hr>
                    <a href="<?= BASE_URL; ?>admin/manageUser" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
