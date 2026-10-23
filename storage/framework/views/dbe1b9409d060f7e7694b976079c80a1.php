

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-header">
        <h2 class="fw-bold text-success">Selamat Datang di Dashboard Admin</h2>
        <p class="text-muted">Kelola semua data toko Anda dari satu tempat</p>
    </div>
    
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card produk">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam stat-icon"></i>
                    <h5 class="card-title">Total Produk</h5>
                    <div class="stat-number text-success"><?php echo e(DB::table('produk')->count()); ?></div>
                    <small class="text-muted">Produk terdaftar</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card kategori">
                <div class="card-body text-center">
                    <i class="bi bi-tags stat-icon"></i>
                    <h5 class="card-title">Kategori</h5>
                    <div class="stat-number text-primary"><?php echo e(DB::table('kategori')->count()); ?></div>
                    <small class="text-muted">Kategori produk</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stok">
                <div class="card-body text-center">
                    <i class="bi bi-archive stat-icon"></i>
                    <h5 class="card-title">Total Stok</h5>
                    <div class="stat-number text-warning"><?php echo e(DB::table('produk')->sum('stok')); ?></div>
                    <small class="text-muted">Unit tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card transaksi">
                <div class="card-body text-center">
                    <i class="bi bi-receipt stat-icon"></i>
                    <h5 class="card-title">Transaksi</h5>
                    <div class="stat-number text-danger"><?php echo e(DB::table('transaksi')->count()); ?></div>
                    <small class="text-muted">Transaksi tercatat</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="welcome-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold">Kelola Bisnis Anda dengan Mudah</h3>
                <p class="mb-0">Gunakan menu navigasi di sebelah kiri untuk mengelola produk, stok, kategori, dan transaksi toko Anda.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-graph-up-arrow display-1 opacity-75"></i>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/admin.blade.php ENDPATH**/ ?>