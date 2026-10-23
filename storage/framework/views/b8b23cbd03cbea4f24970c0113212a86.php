<html>
<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background-color: #198754;
            color: white;
            padding: 15px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-link {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            display: block;
            transition: all 0.3s ease;
        }
        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: white !important;
            color: #198754 !important;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5 class="text-uppercase fw-bold mb-4">
                <a href="<?php echo e(route('dashboard.owner')); ?>" class="text-white text-decoration-none">Dashboard Owner</a>
            </h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="<?php echo e(url('owner/tampil-User')); ?>" class="nav-link sidebar-link <?php echo e(request()->is('owner/tampil-User') ? 'active' : ''); ?>">
                        <i class="bi bi-people-fill me-2"></i> Data User
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="<?php echo e(url('owner/laporan')); ?>" class="nav-link sidebar-link <?php echo e(request()->is('owner/laporan') ? 'active' : ''); ?>">
                        <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan
                    </a>
                </li>
                <hr>
                <li class="nav-item mt-4">
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-light w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/layouts/owner.blade.php ENDPATH**/ ?>