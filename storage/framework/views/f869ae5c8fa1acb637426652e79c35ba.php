

<?php $__env->startSection('title', 'Stok Masuk - Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-success mb-1">
                        <i class="bi bi-box-arrow-in-down me-2"></i>Stok Masuk
                    </h2>
                    <p class="text-muted mb-0">Kelola dan pantau stok masuk ke inventory</p>
                </div>
                <div class="d-flex gap-2">
                    
                    <a href="<?php echo e(route('stok-masuk.export-pdf')); ?>" class="btn btn-outline-danger" id="exportPdf" target="_blank">
                        <i class="bi bi-file-pdf me-2"></i>Export PDF
                    </a>
                    
                    <a href="<?php echo e(route('stok-masuk.form')); ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Stok Masuk
                    </a>
                </div>
            </div>

            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Transaksi</h6>
                                    <h3 class="mb-0 text-primary"><?php echo e($historiStokMasuk->where('tipe', 'Stok Masuk')->count()); ?></h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-receipt text-primary fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Item</h6>
                                    <h3 class="mb-0 text-success">
                                        <?php echo e($historiStokMasuk->where('tipe', 'Stok Masuk')->sum(function($histori) {
                                            return $histori->detailStokMasuk->sum('qty');
                                        })); ?>

                                    </h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-box-seam text-success fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Nilai</h6>
                                    <h4 class="mb-0 text-warning">
                                        Rp <?php echo e(number_format($historiStokMasuk->where('tipe', 'Stok Masuk')->sum(function($histori) {
                                            return $histori->detailStokMasuk->sum('total');
                                        }), 0, ',', '.')); ?>

                                    </h4>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-currency-dollar text-warning fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table me-2"></i>Daftar Stok Masuk
                        </h5>
                        <span class="badge bg-light text-dark fs-6">
                            <?php echo e($historiStokMasuk->where('tipe', 'Stok Masuk')->count()); ?> Data
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tabel-stok-masuk">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%" class="ps-4">No.</th>
                                    <th width="12%">ID Histori</th>
                                    <th width="28%">Keterangan</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="15%">Total Item</th>
                                    <th width="20%">Total Nilai</th>
                                    <th width="5%" class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $stokMasukData = $historiStokMasuk->where('tipe', 'Stok Masuk');
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $stokMasukData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-semibold"><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <span class="badge bg-dark fs-6">#<?php echo e($histori->id); ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-seam me-2 text-success"></i>
                                            <span class="text-truncate" style="max-width: 200px;">
                                                <?php echo e($histori->keterangan); ?>

                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold"><?php echo e($histori->created_at->format('d M Y')); ?></span>
                                            <small class="text-muted"><?php echo e($histori->created_at->format('H:i')); ?></small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                                            <?php echo e($histori->detailStokMasuk->sum('qty')); ?> item
                                        </span>
                                    </td>
                                    <td class="fw-bold text-success fs-6">
                                        Rp <?php echo e(number_format($histori->detailStokMasuk->sum('total'), 0, ',', '.')); ?>

                                    </td>
                                    <td class="text-center pe-4">
                                        <button class="btn btn-primary btn-sm px-3 py-2" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal-<?php echo e($histori->id); ?>"
                                                title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            <h5 class="mb-3">Tidak ada data stok masuk</h5>
                                            <a href="<?php echo e(route('stok-masuk.form')); ?>" class="btn btn-success btn-lg">
                                                <i class="bi bi-plus-circle me-2"></i>Tambah Stok Masuk Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__currentLoopData = $historiStokMasuk->where('tipe', 'Stok Masuk'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $histori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailModal-<?php echo e($histori->id); ?>" tabindex="-1" aria-labelledby="detailModalLabel-<?php echo e($histori->id); ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="detailModalLabel-<?php echo e($histori->id); ?>">
                    <i class="bi bi-list-ul me-2"></i>Detail Stok Masuk #<?php echo e($histori->id); ?>

                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-success mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Transaksi
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>ID Transaksi</strong></td>
                                        <td>: #<?php echo e($histori->id); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: <?php echo e($histori->created_at->format('d F Y H:i')); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan</strong></td>
                                        <td>: <?php echo e($histori->keterangan); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-success mb-3">
                                    <i class="bi bi-graph-up me-2"></i>Ringkasan
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>Total Item</strong></td>
                                        <td>: <?php echo e($histori->detailStokMasuk->sum('qty')); ?> item</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Produk</strong></td>
                                        <td>: <?php echo e($histori->detailStokMasuk->count()); ?> produk</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Nilai</strong></td>
                                        <td class="fw-bold text-success">: Rp <?php echo e(number_format($histori->detailStokMasuk->sum('total'), 0, ',', '.')); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
                <h6 class="text-success mb-3">
                    <i class="bi bi-box-seam me-2"></i>Detail Barang
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="45%">Nama Produk</th>
                                <th width="15%" class="text-center">Qty</th>
                                <th width="20%" class="text-end">Harga Satuan</th>
                                <th width="15%" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $histori->detailStokMasuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center fw-semibold"><?php echo e($index + 1); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if($stok->produk->foto): ?>
                                            <img src="<?php echo e(asset($stok->produk->foto)); ?>" 
                                                 alt="<?php echo e($stok->produk->nama_produk); ?>" 
                                                 class="rounded me-3" 
                                                 width="45" height="45" 
                                                 style="object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 45px; height: 45px;">
                                                <i class="bi bi-image text-white fs-5"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-semibold"><?php echo e($stok->produk->nama_produk); ?></div>
                                            <small class="text-muted">Kode: <?php echo e($stok->produk->id); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary fs-6 px-3"><?php echo e($stok->qty); ?></span>
                                </td>
                                <td class="text-end fw-semibold">Rp <?php echo e(number_format($stok->harga, 0, ',', '.')); ?></td>
                                <td class="text-end fw-bold text-success fs-6">Rp <?php echo e(number_format($stok->total, 0, ',', '.')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">TOTAL:</td>
                                <td class="text-end fw-bold">-</td>
                                <td class="text-end fw-bold text-success fs-5">
                                    Rp <?php echo e(number_format($histori->detailStokMasuk->sum('total'), 0, ',', '.')); ?>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .card {
        border-radius: 12px;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.95rem;
        padding: 1rem 0.75rem;
        border-bottom: 2px solid #198754;
    }
    
    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .btn-sm {
        border-radius: 8px;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(25, 135, 84, 0.05);
    }
    
    .modal-header {
        border-radius: 0;
        border-bottom: 2px solid #198754;
    }
    
    /* Style untuk tombol Export PDF */
    .btn-outline-danger {
        border: 2px solid #dc3545;
        color: #dc3545;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        // Initialize DataTable with better configuration
        $('#tabel-stok-masuk').DataTable({
            searching: true,
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            language: {
                search: "Cari:",
                paginate: {
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                lengthMenu: "Tampilkan _MENU_ data",
                emptyTable: "Tidak ada data stok masuk",
                zeroRecords: "Data tidak ditemukan"
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            initComplete: function() {
                // Style the search input
                $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Cari ID atau keterangan...');
                $('.dataTables_length select').addClass('form-select');
            }
        });

        // Export PDF functionality
        $('#exportPdf').on('click', function(e) {
            e.preventDefault();
            
            // Tampilkan konfirmasi
            if (confirm('Export data Stok Masuk ke PDF?')) {
                // Tampilkan loading
                const originalText = $(this).html();
                $(this).html('<i class="bi bi-hourglass-split me-2"></i>Loading...').prop('disabled', true);
                
                // Redirect ke route export PDF
                window.location.href = "<?php echo e(route('stok-masuk.export-pdf')); ?>";
                
                // Reset tombol setelah 2 detik
                setTimeout(() => {
                    $(this).html(originalText).prop('disabled', false);
                }, 2000);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Produk/stokMasuk.blade.php ENDPATH**/ ?>