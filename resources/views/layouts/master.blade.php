<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #198754;
            --light-green: #d4edda;
            --hover-green: #157347;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-green) 0%, #0d6e3f 100%);
            color: white;
            height: 100vh;
            padding: 1.5rem 1rem;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed) ease;
            position: fixed;
            width: 261px;
            z-index: 1000;
        }

        .sidebar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-brand a:hover {
            transform: translateX(5px);
        }

        .sidebar-link {
            color: white !important;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar-link:hover {
            background-color: white !important;
            color: var(--primary-green) !important;
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-link.active {
            background-color: white;
            color: var(--primary-green) !important;
            font-weight: 600;
        }

        .submenu-bg {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            margin: 0.5rem 0;
            padding: 0.5rem 0;
        }

        .submenu-link {
            color: #e8f5e9 !important;
            padding: 0.5rem 1rem 0.5rem 2rem;
            border-radius: 5px;
            transition: all var(--transition-speed) ease;
        }

        .submenu-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .rotate {
            transition: transform var(--transition-speed) ease;
        }

        .rotate.down {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: 261px;
            padding: 2rem;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .dashboard-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all var(--transition-speed) ease;
            border: none;
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-body {
            padding: 1.5rem;
            position: relative;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .stat-card.produk .stat-icon {
            color: var(--primary-green);
        }

        .stat-card.kategori .stat-icon {
            color: #0d6efd;
        }

        .stat-card.stok .stat-icon {
            color: #fd7e14;
        }

        .stat-card.transaksi .stat-icon {
            color: #dc3545;
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary-green) 0%, #0d6e3f 100%);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: var(--card-shadow);
        }

        .logout-btn {
            background-color: rgba(220, 53, 69, 0.9);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all var(--transition-speed) ease;
            width: 100%;
            text-align: left;
            color: white;
            margin-top: 1rem;
        }

        .logout-btn:hover {
            background-color: #dc3545;
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .main-content {
            margin-left: 250px;
            /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <a href="admin">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                </a>
            </div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="tampil-produk" class="nav-link sidebar-link">
                        <i class="bi bi-box-seam me-2"></i>Data Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#stokSubmenu" role="button" aria-expanded="false"
                        aria-controls="stokSubmenu" onclick="toggleArrow(this)">
                        <span><i class="bi bi-archive me-2"></i>Data Stok</span>
                        <i class="bi bi-chevron-down rotate"></i>
                    </a>
                    <div class="collapse ps-3 submenu-bg" id="stokSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="stok-masuk" class="nav-link submenu-link">
                                    <i class="bi bi-box-arrow-in-down me-2"></i>Stok Masuk
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="stok-keluar" class="nav-link submenu-link">
                                    <i class="bi bi-box-arrow-up me-2"></i>Stok Keluar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="stok-opname" class="nav-link submenu-link">
                                    <i class="bi bi-clipboard-data me-2"></i>Stok Opname
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="tampil-kategori" class="nav-link sidebar-link">
                        <i class="bi bi-tags me-2"></i>Data Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a href="tampil-transaksi" class="nav-link sidebar-link">
                        <i class="bi bi-receipt me-2"></i>Data Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleArrow(element) {
            const icon = element.querySelector('.rotate');
            icon.classList.toggle('down');
        }

        // Menambahkan efek aktif pada menu yang sedang diklik
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Hapus kelas aktif dari semua link
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    // Tambahkan kelas aktif ke link yang diklik
                    this.classList.add('active');
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
