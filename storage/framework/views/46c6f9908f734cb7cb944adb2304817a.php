<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Manajemen Akun</h1>
        <a href="<?php echo e(route('akun.create')); ?>" class="btn btn-primary mb-3">Tambah Akun</a>

        <!-- Tabel untuk menampilkan data akun -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $akuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($akun->name); ?></td>
                    <td><?php echo e($akun->email); ?></td>
                    <td><?php echo e($akun->role); ?></td>
                    <td>
                    <a href="<?php echo e(route('akun.edit', $akun->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('akun.destroy', $akun->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\try\resources\views/akun/dashboard.blade.php ENDPATH**/ ?>