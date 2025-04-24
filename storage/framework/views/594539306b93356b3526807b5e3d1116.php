
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="my-4">Edit Akun</h1>
        <form action="<?php echo e(route('akun.update', $akun->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> <!-- Method spoofing untuk update -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="<?php echo e($akun->name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo e($akun->email); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control" required>
                    <option value="siswa aktif" <?php echo e($akun->role == 'siswa aktif' ? 'selected' : ''); ?>>Siswa Aktif</option>
                    <option value="calon siswa" <?php echo e($akun->role == 'calon siswa' ? 'selected' : ''); ?>>Calon Siswa</option>
                    <option value="alumni" <?php echo e($akun->role == 'alumni' ? 'selected' : ''); ?>>Alumni</option>
                </select>
            </div>
            
            <div class="form-group" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo e(route('akun.index')); ?>" class="btn btn-secondary ml-2">Kembali</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/akun/edit.blade.php ENDPATH**/ ?>