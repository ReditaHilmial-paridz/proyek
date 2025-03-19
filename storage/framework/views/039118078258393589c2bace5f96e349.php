

<?php $__env->startSection('content'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/akun/create.blade.php ENDPATH**/ ?>