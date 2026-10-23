

<?php $__env->startSection('content'); ?>

<style>
    .sidebar-link:hover {
        background-color: white !important;
        color: green !important;
        border-radius: 5px;
    }
    .submenu-bg {
        background-color: #d4edda;
        border-radius: 5px;
    }

    .rotate {
        transition: transform 0.3s ease;
    }

    .rotate.down {
        transform: rotate(180deg);
    }
</style>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-success text-white vh-100 p-3" style="width: 250px;">
        <h5 class="text-uppercase fw-bold" href="admin"><a href="admin" class="text-white text-decoration-none">Dashboard Admin</a></h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="tampil-produk" class="nav-link text-white sidebar-link">Data Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#stokSubmenu" role="button"
                    aria-expanded="false" aria-controls="stokSubmenu"
                    onclick="toggleArrow(this)">
                    <span>Data Stok</span>
                    <i class="bi bi-chevron-down rotate"></i>
                </a>
                <div class="collapse ps-3 submenu-bg" id="stokSubmenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="stok-masuk" class="nav-link text-dark sidebar-link">Stok Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="stok-keluar" class="nav-link text-dark sidebar-link">Stok Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a href="stok-opname" class="nav-link text-dark sidebar-link">Stok Opname</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="tampil-kategori" class="nav-link text-white sidebar-link">Data Kategori</a>
            </li>
            <li class="nav-item">
                <a href="tampil-transaksi" class="nav-link text-white sidebar-link">Data Transaksi</a>
            </li>
            <li class="nav-item mt-3">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger w-100 text-start">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1 p-4">
        <h2>Stok Masuk</h2>

        <div class="">
            <a href="" class="btn btn-danger">Export PDF</a>
            <a href="<?php echo e(route('stok-masuk.form')); ?>" class="btn btn-success me-2">Tambah Data</a>
        </div>
        <br>
        <table class="table table-bordered table-striped table-section" id="tabel-laporan">
            <thead class="table-success">
                <tr>
                    <th>No.</th>
                    <th>ID Histori</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php $__currentLoopData = $historiStokMasuk->where('tipe','Stok Masuk'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($no++); ?>.</td>
                    <td><?php echo e($histori ->id); ?></td>
                    <td><?php echo e($histori ->keterangan); ?></td>
                    <td><?php echo e($histori ->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal-<?php echo e($histori->id); ?>">
                            Detail
                        </button>
                    </td>
                </tr>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php $__currentLoopData = $historiStokMasuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="detailModal-<?php echo e($histori->id); ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Stok #<?php echo e($histori->id); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $histori->detailStokMasuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($stok->produk->nama_produk); ?></td>
                                    <td class="text-end">Rp<?php echo e(number_format($stok->harga, 0, ',', '.')); ?></td>
                                    <td><?php echo e($stok->qty); ?></td>
                                    <td class="text-end">Rp<?php echo e(number_format($stok->total, 0, ',', '.')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>

<script>
    function toggleArrow(element) {
        const icon = element.querySelector('i');
        icon.classList.toggle('down');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/dashboard_admin/Produk/stokMasuk.blade.php ENDPATH**/ ?>