<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #198754;
            --primary-dark: #146c43;
            --primary-light: #20c997;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 60px;
            --transition-speed: 0.3s;
            --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 15px;
            box-shadow: var(--shadow-medium);
            z-index: 1000;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .sidebar-title i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .toggle-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform var(--transition-speed) ease;
            padding: 5px;
            border-radius: 4px;
        }
        
        .toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar.collapsed .toggle-btn {
            transform: rotate(180deg);
        }
        
        .sidebar-nav {
            flex-grow: 1;
        }
        
        .sidebar-link {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: white;
        }
        
        .sidebar-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            min-width: 20px;
            text-align: center;
        }
        
        .sidebar-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.2);
            margin: 20px 0;
        }
        
        /* Main Content Styles */
        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
        }
        
        .content.expanded {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }
        
        /* Header Styles */
        .header {
            background-color: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
        
        .header-title p {
            color: #6c757d;
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .content {
                margin-left: 0;
                width: 100%;
            }
            
            .mobile-menu-btn {
                display: block !important;
            }
        }
        
        @media (min-width: 993px) {
            .mobile-menu-btn {
                display: none !important;
            }
        }
        
        .mobile-menu-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 999;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: var(--shadow-medium);
            transition: all 0.3s ease;
        }
        
        .mobile-menu-btn:hover {
            background-color: var(--primary-dark);
            transform: scale(1.05);
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            backdrop-filter: blur(2px);
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Logout Button */
        .logout-btn {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            text-align: left;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }
        
        .logout-btn i {
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        /* Content Card */
        .content-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            padding: 25px;
            margin-bottom: 25px;
        }
        
        /* Animation for page transitions */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        /* Focus states for accessibility */
        .sidebar-link:focus,
        .toggle-btn:focus,
        .logout-btn:focus,
        .mobile-menu-btn:focus {
            outline: 2px solid rgba(255, 255, 255, 0.5);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle Menu">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Overlay for Mobile -->
    <div class="overlay" id="overlay"></div>
    
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard.owner') }}" class="sidebar-title">
                    <i class="fas fa-chart-line"></i>
                    <span class="sidebar-text">Dashboard Owner</span>
                </a>
                <button class="toggle-btn" id="toggleBtn" aria-label="Toggle Sidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            
            <div class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ url('owner/tampil-User') }}" class="nav-link sidebar-link {{ request()->is('owner/tampil-User') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <span class="sidebar-text">Data User</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ url('owner/laporan') }}" class="nav-link sidebar-link {{ request()->is('owner/laporan') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-bar-graph-fill"></i>
                            <span class="sidebar-text">Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="sidebar-footer">
                <div class="sidebar-divider"></div>
                
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content" id="mainContent">
            <!-- Header -->
            <div class="header">
                <div class="header-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-description', 'Selamat datang di dashboard owner')</p>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="fade-in">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleBtn');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const overlay = document.getElementById('overlay');
            
            // Check if sidebar state is saved in localStorage
            const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isSidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
            
            // Toggle sidebar collapse/expand
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
            
            // Mobile menu toggle
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            });
            
            // Close sidebar when clicking on overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });
            
            // Auto-close sidebar on mobile when clicking a link
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('mobile-open');
                        overlay.classList.remove('active');
                    }
                });
            });
            
            // Add confirmation for logout
            const logoutForm = document.getElementById('logoutForm');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    if (!confirm('Apakah Anda yakin ingin logout?')) {
                        e.preventDefault();
                    }
                });
            }
            
            // Add keyboard navigation support
            document.addEventListener('keydown', function(e) {
                // Close sidebar with Escape key
                if (e.key === 'Escape' && window.innerWidth < 992 && sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>