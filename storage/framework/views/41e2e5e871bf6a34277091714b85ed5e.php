

<?php $__env->startSection('content'); ?>

    <style>
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background-color: #198754;
            /* Warna hijau */
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
            /* Sesuaikan agar tidak tertutup sidebar */
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
        <h5 class="text-uppercase fw-bold mb-4"><a href="owner" class="text-white text-decoration-none">Dashboard Owner</a>
        </h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="tampil-User" class="nav-link text-white sidebar-link">
                    <i class="bi bi-people-fill me-2"></i> Data User
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="laporan" class="nav-link text-white sidebar-link">
                    <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan
                </a>
            </li>
            <!-- Dropdown Biaya Operasional -->
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-white sidebar-link d-flex justify-content-between align-items-center"
                    onclick="toggleDropdownBiaya(event)">
                    <span><i class="bi bi-cash-stack me-2"></i> Biaya Operasional</span>
                    <span><i id="arrowBiaya" class="bi bi-chevron-down rotate"></i></span>
                </a>
                <div id="submenuBiaya" class="submenu-bg mt-2" style="display:none;">
                    <a href="gaji-pegawai" class="nav-link text-dark ps-4 py-2">Gaji Pegawai</a>
                    <a href="biaya-toko" class="nav-link text-dark ps-4 py-2">Biaya Toko</a>
                    <a href="biaya-lain" class="nav-link text-dark ps-4 py-2">Biaya Lain-lain</a>
                </div>
            </li>
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
    <script>
        function toggleDropdownBiaya(e) {
            e.preventDefault();
            var submenu = document.getElementById('submenuBiaya');
            var arrow = document.getElementById('arrowBiaya');
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                arrow.classList.add('down');
            } else {
                submenu.style.display = 'none';
                arrow.classList.remove('down');
            }
        }
    </script>

    <div class="content">

        
        <h4 class="mt-4">Tabel Pembeli</h4>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Id Pembeli</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $dataPembeli; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($no + 1); ?></td>
                            <td><?php echo e($data->id); ?></td>
                            <td><?php echo e($data->name); ?></td>
                            <td><?php echo e($data->email); ?></td>
                            <td><?php echo e($data->alamat); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">Tidak ada data pembeli</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <h4 class="mt-4">Tabel Admin</h4>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No.</th>
                        <th>Id Admin</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $dataAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($no + 1); ?></td>
                            <td><?php echo e($data->id); ?></td>
                            <td><?php echo e($data->name); ?></td>
                            <td><?php echo e($data->email); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4">Tidak ada data admin</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php echo $__env->make('layouts.owner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\acer\OneDrive\เอกสาร\sembako_aldi\resources\views/dashboard_owner/user/index.blade.php ENDPATH**/ ?>