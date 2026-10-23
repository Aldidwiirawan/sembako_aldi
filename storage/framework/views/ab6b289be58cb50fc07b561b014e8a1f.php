<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin - SEMBAKO ALDI'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link {
            color: #fff;
            padding: 12px 20px;
            border-bottom: 1px solid #4b545c;
        }
        
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        
        .sidebar .nav-link.active {
            background-color: #007bff;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        .content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        
        .stat-card {
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .dropdown-menu .nav-link {
            border-bottom: none;
            padding: 8px 15px;
        }
    </style>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="position-sticky pt-3">
                <div class="text-center p-3">
                    <h4 class="text-white">SEMBAKO ALDI</h4>
                    <small class="text-muted">Admin Panel</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>" href="<?php echo e(url('/admin/dashboard')); ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('admin/produk*') ? 'active' : ''); ?>" href="<?php echo e(url('/admin/produk')); ?>">
                            <i class="fas fa-box"></i>
                            Data Produk
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo e(Request::is('admin/stok*') ? 'active' : ''); ?>" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-warehouse"></i>
                            Data Stok
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li>
                                <a class="nav-link <?php echo e(Request::is('stok-masuk*') ? 'active' : ''); ?>" href="<?php echo e(url('/stok-masuk')); ?>">
                                    <i class="fas fa-arrow-down"></i>
                                    Stok Masuk
                                </a>
                            </li>
                            <li>
                                <a class="nav-link <?php echo e(Request::is('stok-keluar*') ? 'active' : ''); ?>" href="<?php echo e(url('/stok-keluar')); ?>">
                                    <i class="fas fa-arrow-up"></i>
                                    Stok Keluar
                                </a>
                            </li>
                            <li>
                                <a class="nav-link <?php echo e(Request::is('stok-opname*') ? 'active' : ''); ?>" href="<?php echo e(url('/stok-opname')); ?>">
                                    <i class="fas fa-clipboard-check"></i>
                                    Stok Opname
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('admin/kategori*') ? 'active' : ''); ?>" href="<?php echo e(url('/admin/kategori')); ?>">
                            <i class="fas fa-tags"></i>
                            Data Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('admin/transaksi*') ? 'active' : ''); ?>" href="<?php echo e(url('/admin/transaksi')); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            Data Transaksi
                        </a>
                    </li>
                </ul>
                
                <div class="mt-auto p-3">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="content flex-grow-1">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i>
                                    Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('profile')); ?>">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <!-- Bootstrap & JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggler = document.querySelector('.navbar-toggler');
            const sidebar = document.getElementById('sidebar');
            
            sidebarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('d-none');
                sidebar.classList.toggle('d-md-block');
            });
        });
    </script>
    
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/layouts/admin.blade.php ENDPATH**/ ?>