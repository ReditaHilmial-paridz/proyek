

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center py-4 border-bottom">
        <div>
            <h1 class="h3 mb-0">
                <i class="fas fa-user-shield text-primary me-2"></i>Admin Dashboard
            </h1>
            <p class="text-muted mb-0">Selamat datang di panel administrasi</p>
        </div>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>

    <!-- Welcome Card -->
    <div class="card border-0 shadow-sm my-4">
        <div class="card-body text-center py-5">
            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-block p-4 mb-3">
                <i class="fas fa-user-cog fa-4x text-primary"></i>
            </div>
            <h2 class="card-title">Halo, Administrator!</h2>
            <p class="card-text lead text-muted">Anda memiliki akses penuh ke sistem ini</p>
        </div>
    </div>

    <!-- System Info Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0">
                <i class="fas fa-info-circle text-info me-2"></i>Informasi Sistem
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Versi Aplikasi
                            <span class="badge bg-light text-dark">v1.0.2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Status Sistem
                            <span class="badge bg-success">Aktif</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Terakhir Diperbarui
                            <span>20 Apr 2025</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Tanggal Hari Ini
                            <span id="current-date"><?php echo e(date('d M Y')); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-3 text-center text-muted">
        <small>
            &copy; 2025 Sistem Administrasi | 
            <i class="fas fa-shield-alt text-primary mx-1"></i> 
            Hak Akses Administrator
        </small>
    </footer>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .card {
        border-radius: 10px;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    body {
        background-color: #f5f7fa;
    }
    
    a.card:hover {
        text-decoration: none;
    }
</style>
<script>
    function updateTime() {
        const now = new Date();
        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\try\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>