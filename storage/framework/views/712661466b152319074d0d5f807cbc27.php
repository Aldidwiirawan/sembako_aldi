

<?php $__env->startSection('title', 'Data Produk - Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-success mb-1">
                <i class="bi bi-box-seam me-2"></i>Data Produk
            </h2>
            <p class="text-muted mb-0">
                Total <?php echo e($dataproduk->count()); ?> produk terdaftar dalam sistem
            </p>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-success"> <i class="bi bi-plus-circle me-2"></i>Tambah Produk
            </a>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-3 mb-4">
        
        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Total Produk</h6>
                            <h3 class="fw-bold text-primary mb-0"><?php echo e($dataproduk->count()); ?></h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Stok Sedikit</h6>
                            <h3 class="fw-bold text-warning mb-0">
                                <?php echo e($dataproduk->where('stok', '>', 0)->where('stok', '<=', 10)->count()); ?>

                            </h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Stok Habis</h6>
                            <h3 class="fw-bold text-danger mb-0"><?php echo e($dataproduk->where('stok', 0)->count()); ?></h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-x-circle text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Total Modal</h6>
                            <h3 class="fw-bold text-success mb-0" style="font-size: 1.3rem;">
                                Rp <?php echo e(number_format($totalModal, 0, ',', '.')); ?>

                            </h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-currency-dollar text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Estimasi Laba</h6>
                            <h3 class="fw-bold text-info mb-0" style="font-size: 1.3rem;">
                                Rp <?php echo e(number_format($totalLaba, 0, ',', '.')); ?>

                            </h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-graph-up-arrow text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-table me-2"></i>Daftar Produk
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel-produk">
                    <thead class="table-success">
                        <tr>
                            <th width="5%">No.</th>
                            <th width="10%">Kode Produk</th>
                            <th width="12%">Kategori</th>
                            <th width="15%">Nama Produk</th>
                            <th width="10%">Harga Modal</th>
                            <th width="10%">Harga Jual</th>
                            <th width="10%">Laba Satuan</th>
                            <th width="8%">Stok</th>
                            <th width="10%">Foto</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dataproduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <span class="badge bg-dark"><?php echo e($data->id); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark"><?php echo e($data->kategori->nama_kategori); ?></span>
                                </td>
                                <td>
                                    <strong><?php echo e($data->nama_produk); ?></strong>
                                    <?php if($data->stok == 0): ?>
                                        <span class="badge bg-danger ms-1">Habis</span>
                                    <?php elseif($data->stok <= 10): ?>
                                        <span class="badge bg-warning text-dark ms-1">Sedikit</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">Rp <?php echo e(number_format($data->harga_kolak, 0, ',', '.')); ?></td>
                                <td class="text-end">Rp <?php echo e(number_format($data->harga_jual, 0, ',', '.')); ?></td>
                                <td class="text-end text-success fw-bold">
                                    Rp <?php echo e(number_format($data->harga_jual - $data->harga_kolak, 0, ',', '.')); ?>

                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge <?php echo e($data->stok > 10 ? 'bg-success' : ($data->stok > 0 ? 'bg-warning' : 'bg-danger')); ?> fs-6">
                                        <?php echo e($data->stok); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if($data->foto): ?>
                                        <img src="<?php echo e($data->foto); ?>" alt="Foto Produk" width="60" height="60"
                                            class="rounded object-fit-cover" data-bs-toggle="tooltip"
                                            data-bs-title="<?php echo e($data->nama_produk); ?>">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group-vertical btn-group-sm" role="group">
                                        <a href="<?php echo e(route('produk.edit', $data->id)); ?>"
                                            class="btn btn-warning btn-sm mb-1" data-bs-toggle="tooltip"
                                            data-bs-title="Edit Produk">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('produk.delete', $data->id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                                data-bs-toggle="tooltip" data-bs-title="Hapus Produk"
                                                onclick="return confirm('Yakin ingin menghapus produk <?php echo e($data->nama_produk); ?>?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                        Tidak ada data produk
                                    </div>
                                    <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-success mt-2">
                                        <i class="bi bi-plus-circle me-2"></i>Tambah Produk Pertama
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-success fw-bold">
                        <tr>
                            <td colspan="4" class="text-end">TOTAL KESELURUHAN:</td>
                            <td class="text-end">Rp <?php echo e(number_format($totalModal, 0, ',', '.')); ?></td>
                            <td class="text-end">-</td>
                            <td class="text-end text-success">Rp <?php echo e(number_format($totalLaba, 0, ',', '.')); ?></td>
                            <td class="text-center"><?php echo e($dataproduk->sum('stok')); ?></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-body">
                    <h6 class="card-title text-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>Produk Stok Sedikit
                    </h6>
                    <?php
                        $lowStock = $dataproduk->where('stok', '>', 0)->where('stok', '<=', 10);
                    ?>
                    <?php if($lowStock->count() > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $lowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="fw-bold"><?php echo e($product->nama_produk); ?></small>
                                        <br>
                                        <small class="text-muted">Stok: <?php echo e($product->stok); ?></small>
                                    </div>
                                    <span class="badge bg-warning text-dark">Perlu Restock</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">Tidak ada produk dengan stok sedikit</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-body">
                    <h6 class="card-title text-danger">
                        <i class="bi bi-x-circle me-2"></i>Produk Stok Habis
                    </h6>
                    <?php
                        $outOfStock = $dataproduk->where('stok', 0);
                    ?>
                    <?php if($outOfStock->count() > 0): ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $outOfStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <small class="fw-bold"><?php echo e($product->nama_produk); ?></small>
                                    <span class="badge bg-danger">Habis</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">Tidak ada produk yang habis</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .table td {
            vertical-align: middle;
        }

        /* Styling .card di sini sudah bagus, 
          utility class .shadow-sm dari Bootstrap akan menambahkannya
        */
        .card {
            border: none;
            /* box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); */ /* Dihandle .shadow-sm */
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#tabel-produk').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                order: [
                    [1, 'asc']
                ],
                responsive: true,
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>'
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Search functionality
            $('#search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Category filter
            $('#kategoriFilter').on('change', function() {
                table.column(2).search(this.value).draw();
            });

            // Stock filter
            $('#stokFilter').on('change', function() {
                var value = this.value;
                if (value === 'habis') {
                    table.column(7).search('^0$', true, false).draw();
                } else if (value === 'sedikit') {
                    // Custom filtering for low stock (1-10)
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            var stok = parseInt(data[7]) || 0;
                            return stok > 0 && stok <= 10;
                        }
                    );
                    table.draw();
                    $.fn.dataTable.ext.search.pop();
                } else if (value === 'cukup') {
                    table.column(7).search('^([1-9][0-9]+|1[1-9])$', true, false).draw();
                } else {
                    table.column(7).search('').draw();
                }
            });

            // Reset filters
            $('#resetFilter').on('click', function() {
                $('#search').val('');
                $('#kategoriFilter').val('');
                $('#stokFilter').val('');
                table.search('').columns().search('').draw();
            });

            // Auto-refresh page every 30 seconds to update stock data
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 30000);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/produk/index.blade.php ENDPATH**/ ?>