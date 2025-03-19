<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* Struktur dasar */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            background-color: #d9d9d9;
        }

        /* Header */
        .top-header {
            height: 50px;
            background-color: #0d47a1;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* Wrapper flexbox */
        .main-container {
            display: flex;
            flex-grow: 1;
            margin-top: 50px; /* Supaya tidak tertutup header */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: white;
            padding-top: 20px;
            color: #0d47a1;
            flex-shrink: 0;
            height: calc(100vh - 50px);
            position: fixed;
            top: 50px;
            left: 0;
            overflow-y: auto;
        }
        .sidebar a {
            padding: 12px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #0d47a1;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #1976d2;
            border-left: 5px solid white;
            color: white;
        }
        .sidebar i {
            font-size: 18px;
        }

        /* Konten utama */
        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px; /* Menyesuaikan dengan sidebar */
            overflow-y: auto;
            min-height: calc(100vh - 50px);
        }

        /* Styling untuk Accordion */
        .accordion-button {
            background-color: white !important;
            color: #0d47a1 !important;
            border: none;
            padding: 12px 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            text-align: left;
        }
        .accordion-button:hover, .accordion-button:focus {
            background-color: #1976d2 !important;
            color: white !important;
        }
        .accordion-button:not(.collapsed) {
            background-color: #1976d2 !important;
            color: white !important;
        }
        .accordion-body {
            padding: 0;
        }
        .accordion-body a {
            padding: 12px 40px;
            display: block;
            color: #0d47a1;
            text-decoration: none;
        }
        .accordion-body a:hover, .accordion-body .active {
            background-color: #1976d2;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="top-header"></div>

    <!-- Wrapper utama -->
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="<?php echo e(route('akun.index')); ?>" class="<?php echo e(request()->routeIs('akun.index') ? 'active' : ''); ?>">
                <i class="bi bi-person-circle"></i> Manajemen Akun
            </a>
            <a href="<?php echo e(route('fasilitas.index')); ?>" class="<?php echo e(request()->routeIs('fasilitas.index') ? 'active' : ''); ?>">
                <i class="bi bi-archive"></i> Fasilitas
            </a>
            <a href="<?php echo e(route('petugas.index')); ?>" class="<?php echo e(request()->is('petugas*') ? 'active' : ''); ?>">
                <i class="bi bi-people"></i> Petugas
            </a>
            <a href="<?php echo e(route('siswa.index')); ?>" class="<?php echo e(request()->is('data-siswa*') ? 'active' : ''); ?>">
                <i class="bi bi-bar-chart"></i> Data Siswa
            </a>
            
            <!-- Accordion Arsip -->
            <div class="accordion" id="accordionSidebar">
                <div class="accordion-item bg-transparent border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArsip" aria-expanded="false">
                            <i class="bi bi-folder"></i> Arsip
                        </button>
                    </h2>
                    <div id="collapseArsip" class="accordion-collapse collapse <?php echo e(request()->is('arsip*') ? 'show' : ''); ?>" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body">
                            <a href="<?php echo e(route('arsip.index')); ?>" class="<?php echo e(request()->is('arsip/dokumen') ? 'active' : ''); ?>">Form surat</a>
                            <a href="#" class="<?php echo e(request()->is('arsip/laporan') ? 'active' : ''); ?>">Data surat</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Konten -->
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\try\resources\views/layouts/app.blade.php ENDPATH**/ ?>