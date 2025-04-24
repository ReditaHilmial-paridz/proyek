<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* Base Structure */
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }

        /* Header */
        .top-header {
            height: 50px;
            background-color: #0d47a1;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
        }

        /* Main Container */
        .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 50px;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: white;
            color: #0d47a1;
            position: fixed;
            top: 50px;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1020;
        }

        .sidebar a {
            padding: 12px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #0d47a1;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: #1976d2;
            border-left: 5px solid white;
            color: white;
        }

        .sidebar i {
            font-size: 18px;
            min-width: 24px;
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin 0.3s ease;
        }

        /* Accordion Styling */
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
            transition: all 0.3s;
        }

        .accordion-body a:hover, .accordion-body .active {
            background-color: #1976d2;
            color: white;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1040;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            color: #0d47a1;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Table Responsiveness */
        .table-responsive {
            overflow-x: auto;
        }
            /* Footer Styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            z-index: 1000;
            transition: left 0.3s ease;
        }

        @media (max-width: 992px) {
            .footer {
                left: 0;
            }
        }

        .main-container {
            padding-bottom: 60px; /* Match footer height */
        }
    </style>
</head>
<body>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="bi bi-list"></i> Menu
    </button>

    <!-- Header -->
    <div class="top-header"></div>

    <!-- Wrapper utama -->
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{ route('akun.index') }}" class="{{ request()->routeIs('akun.index') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Manajemen Akun
            </a>
            <a href="{{ route('fasilitas.index') }}" class="{{ request()->routeIs('fasilitas.index') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Fasilitas
            </a>
            <a href="{{ route('petugas.index') }}" class="{{ request()->is('petugas*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Petugas
            </a>
            <a href="{{ route('siswa.index') }}" class="{{ request()->is('data-siswa*') ? 'active' : '' }}">
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
                    <div id="collapseArsip" class="accordion-collapse collapse {{ request()->is('arsip*') ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
                        <div class="accordion-body">
                            <a href="{{ route('arsip.create') }}" class="{{ request()->is('arsip/dokumen') ? 'active' : '' }}">Form surat</a>
                            <a href="{{ route('arsip.index') }}" class="{{ request()->is('arsip/laporan') ? 'active' : '' }}">Data surat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten -->
        <div class="content">
            @yield('content')
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light border-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-muted">&copy; 2025 Sarana Prasana. All rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="text-muted">Version 1.0.0</span>
                <a href="#" class="text-decoration-none ms-2 text-primary">Help</a>
                <a href="#" class="text-decoration-none ms-2 text-primary">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.getElementById('mobileMenuBtn');
            
            if (window.innerWidth <= 992 && 
                !sidebar.contains(event.target) && 
                event.target !== mobileBtn && 
                !mobileBtn.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Auto-close sidebar when navigating on mobile
        const sidebarLinks = document.querySelectorAll('.sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
