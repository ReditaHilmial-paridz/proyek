
<?php $__env->startSection('content'); ?>
<h1>Selamat Datang, Admin!</h1>
    <p>Ini adalah halaman dashboard admin.</p>
    <form action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit">Logout</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>