

<?php $__env->startSection('content'); ?>
    <style>
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background-color: #198754;
            color: white;
            padding: 15px;
        }

        .sidebar-link:hover {
            background-color: white !important;
            color: green !important;
            border-radius: 5px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        .table-container {
            max-height: 80vh;
            overflow-y: auto;
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

    <div class="sidebar">
        <h5 class="text-uppercase fw-bold">
            <a href="admin" class="text-white text-decoration-none">Dashboard Admin</a>
        </h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="tampil-produk" class="nav-link text-white sidebar-link">Data Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#stokSubmenu" role="button" aria-expanded="false"
                    aria-controls="stokSubmenu" onclick="toggleArrow(this)">
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

    <div class="content">
        <h2>DATA PRODUK</h2>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="d-flex mb-3">
            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-success me-2">+Tambah Data</a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-striped" id="tabel-produk">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Kode Produk</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga Modal</th>
                        <th>Harga Jual</th>
                        <th>Laba Satuan</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $dataproduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($data->id); ?></td>
                            <td><?php echo e($data->kategori->nama_kategori); ?></td>
                            <td><?php echo e($data->nama_produk); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($data->harga_kolak, 0, ',', '.')); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($data->harga_jual, 0, ',', '.')); ?></td>
                            <td class="text-end text-success fw-bold">
                                Rp <?php echo e(number_format($data->harga_jual - $data->harga_kolak, 0, ',', '.')); ?>

                            </td>
                            <td><?php echo e($data->stok); ?></td>
                            <td>
                                <img src="<?php echo e(asset($data->foto)); ?>" alt="Foto Produk" width="80">
                            </td>
                            <td>
                                <form action="<?php echo e(route('produk.delete', $data->id)); ?>" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="<?php echo e(route('produk.edit', $data->id)); ?>" class="btn btn-warning btn-sm">Ubah</a>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-success fw-bold">
                        <td colspan="2" class="text-end">Total Modal</td>
                        <td class="text-end">
                            Rp <?php echo e(number_format($totalModal, 0, ',', '.')); ?>

                        </td>
                        <td colspan="3" class="text-end">Total Laba</td>
                        <td class="text-end text-success">
                            Rp <?php echo e(number_format($totalLaba, 0, ',', '.')); ?>

                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleArrow(element) {
            const icon = element.querySelector('i');
            icon.classList.toggle('down');
        }
    </script>

    
    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabel-produk').DataTable();
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\acer\OneDrive\เอกสาร\sembako_aldi\resources\views/dashboard_admin/produk/index.blade.php ENDPATH**/ ?>