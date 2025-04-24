<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, User!</h1>
    <p>Ini adalah halaman dashboard user.</p>
    <form action="<?php echo e(route('logout')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit">Logout</button>
    </form>
</body>
</html><?php /**PATH C:\laragon\www\try\resources\views/user/dashboard.blade.php ENDPATH**/ ?>