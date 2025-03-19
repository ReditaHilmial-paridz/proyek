<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Tambah Akun</h1>
        <form action="<?php echo e(route('akun.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            <option value="siswa aktif">Siswa Aktif</option>
            <option value="calon siswa">Calon Siswa</option>
            <option value="alumni">Alumni</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\try\resources\views/akun/create.blade.php ENDPATH**/ ?>