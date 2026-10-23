

<?php $__env->startSection('content'); ?>

<style>
    .content {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .table-container {
        max-height: 75vh;
        overflow-y: auto;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 12px;
        background: white;
    }

    .btn-custom {
        border: 2px solid #198754;
        color: #198754;
        transition: all 0.3s ease;
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        font-weight: 500;
        padding: 10px 20px;
    }

    .btn-custom:hover,
    .btn-custom:active,
    .btn-custom:focus {
        background-color: #198754 !important;
        color: white !important;
        border-color: #198754 !important;
        transform: translateY(-2px);
    }

    .btn-custom.active {
        background-color: #198754 !important;
        color: white !important;
        box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3);
    }

    .table-section {
        display: none;
        margin-bottom: 0;
    }

    .table-section.active {
        display: table;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-dikirim {
        background-color: #cce7ff;
        color: #004085;
        border: 1px solid #b3d7ff;
    }

    .status-selesai {
        background-color: #d1edff;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 12px 12px 0 0;
        padding: 20px;
    }

    .table th {
        position: sticky;
        top: 0;
        background-color: #198754;
        color: white;
        z-index: 10;
        padding: 15px 12px;
        font-weight: 600;
        border: none;
    }

    .table td {
        padding: 12px;
        vertical-align: middle;
        border-color: #f1f3f4;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #dee2e6;
        opacity: 0.7;
    }

    .empty-state p {
        font-size: 1.1rem;
        margin: 0;
        color: #8a8d93;
    }

    .page-header {
        background: linear-gradient(135deg, #198754, #146c43);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        border: 1px solid #e9ecef;
    }

    .btn-group-custom {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .content {
            padding: 15px;
        }
        
        .table-container {
            overflow-x: auto;
            font-size: 0.9rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-group-custom {
            justify-content: center;
        }
        
        .page-header {
            padding: 20px;
            text-align: center;
        }
    }

    /* Hover effects for table rows */
    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.002);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Custom scrollbar */
    .table-container::-webkit-scrollbar {
        width: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 0 12px 12px 0;
    }

    .table-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h3 mb-2">DATA TRANSAKSI</h1>
                <p class="mb-0 opacity-75">Kelola dan pantau semua transaksi pelanggan di satu tempat</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="bg-white text-dark d-inline-block px-3 py-2 rounded-pill">
                    <small class="text-muted">Total Transaksi:</small>
                    <strong class="text-success"><?php echo e($dataTransaksi->count()); ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 text-dark">Filter Status Transaksi</h5>
            </div>
            <div class="col-md-6">
                <div class="btn-group-custom justify-content-md-end">
                    <button type="button" class="btn btn-custom active" data-status="pending">
                        <i class="bi bi-clock me-2"></i>Pending
                    </button>
                    <button type="button" class="btn btn-custom" data-status="dikirim">
                        <i class="bi bi-truck me-2"></i>Dikirim
                    </button>
                    <button type="button" class="btn btn-custom" data-status="selesai">
                        <i class="bi bi-check-circle me-2"></i>Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Container -->
    <div class="table-container">
        <!-- Tabel Pending -->
        <table class="table table-hover table-section active" id="tabel-pending">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 15%">Pembeli</th>
                    <th style="width: 15%">Harga</th>
                    <th style="width: 10%">Jumlah</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Tanggal Transaksi</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dataTransaksi->where('status','pending')->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong>#<?php echo e($transaction->id); ?></strong></td>
                    <td><?php echo e($transaction->user ? $transaction->user->name : '-'); ?></td>
                    <td>Rp <?php echo e(number_format($transaction->harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($transaction->details->sum('jumlah')); ?></td>
                    <td><span class="status-badge status-pending"><?php echo e(ucfirst($transaction->status)); ?></span></td>
                    <td><?php echo e(\Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i')); ?></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-<?php echo e($transaction->id); ?>">
                                <i class="bi bi-eye me-1"></i> Detail
                            </button>
                            <?php if($transaction->status == 'pending'): ?>
                            <form action="<?php echo e(url('/transaksi/kirim/' . $transaction->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-truck me-1"></i> Kirim
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Tidak ada transaksi dengan status pending</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tabel Dikirim -->
        <table class="table table-hover table-section" id="tabel-dikirim">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 15%">Pembeli</th>
                    <th style="width: 15%">Harga</th>
                    <th style="width: 10%">Jumlah</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Tanggal Transaksi</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dataTransaksi->where('status','dikirim')->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong>#<?php echo e($transaction->id); ?></strong></td>
                    <td><?php echo e($transaction->user ? $transaction->user->name : '-'); ?></td>
                    <td>Rp <?php echo e(number_format($transaction->harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($transaction->details->sum('jumlah')); ?></td>
                    <td><span class="status-badge status-dikirim"><?php echo e(ucfirst($transaction->status)); ?></span></td>
                    <td><?php echo e(\Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i')); ?></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-<?php echo e($transaction->id); ?>">
                                <i class="bi bi-eye me-1"></i> Detail
                            </button>
                            <form action="<?php echo e(url('/transaksi/sampai/' . $transaction->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle me-1"></i> Sampai
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Tidak ada transaksi dengan status dikirim</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Tabel Selesai -->
        <table class="table table-hover table-section" id="tabel-selesai">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 15%">Pembeli</th>
                    <th style="width: 15%">Harga</th>
                    <th style="width: 10%">Jumlah</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Tanggal Transaksi</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dataTransaksi->where('status','selesai')->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong>#<?php echo e($transaction->id); ?></strong></td>
                    <td><?php echo e($transaction->user ? $transaction->user->name : '-'); ?></td>
                    <td>Rp <?php echo e(number_format($transaction->harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($transaction->details->sum('jumlah')); ?></td>
                    <td><span class="status-badge status-selesai"><?php echo e(ucfirst($transaction->status)); ?></span></td>
                    <td><?php echo e(\Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i')); ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-<?php echo e($transaction->id); ?>">
                            <i class="bi bi-eye me-1"></i> Detail
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Tidak ada transaksi dengan status selesai</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modals -->
<?php $__currentLoopData = $dataTransaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailModal-<?php echo e($transaction->id); ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi #<?php echo e($transaction->id); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Transaksi</h6>
                        <p><strong>ID Pesanan:</strong> <?php echo e($transaction->id); ?></p>
                        <p><strong>Status:</strong> <span class="status-badge status-<?php echo e($transaction->status); ?>"><?php echo e(ucfirst($transaction->status)); ?></span></p>
                        <p><strong>Tanggal Transaksi:</strong> <?php echo e(\Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i')); ?></p>
                        <?php if($transaction->tanggal_bayar): ?>
                        <p><strong>Tanggal Bayar:</strong> <?php echo e(\Carbon\Carbon::parse($transaction->tanggal_bayar)->format('d M Y, H:i')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Pembeli</h6>
                        <p><strong>Nama:</strong> <?php echo e($transaction->user ? $transaction->user->name : '-'); ?></p>
                        <p><strong>Email:</strong> <?php echo e($transaction->user ? $transaction->user->email : '-'); ?></p>
                        <p><strong>Alamat:</strong> <?php echo e($transaction->user ? $transaction->user->alamat : '-'); ?></p>
                    </div>
                </div>
                
                <hr>
                
                <h6>Detail Produk</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transaction->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($detail->produk->nama_produk); ?></td>
                                <td>Rp <?php echo e(number_format($detail->harga_satuan, 0, ',', '.')); ?></td>
                                <td><?php echo e($detail->jumlah); ?></td>
                                <td>Rp <?php echo e(number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Ongkir:</strong></td>
                                <td>Rp 16.000</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp <?php echo e(number_format($transaction->harga, 0, ',', '.')); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <?php if($transaction->snap_token): ?>
                <p><strong>Snap Token:</strong> <code><?php echo e($transaction->snap_token); ?></code></p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tampilan tabel
        showTable('pending');
        
        // Event listener untuk tombol filter
        document.querySelectorAll('.btn-custom').forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                // Hapus kelas active dari semua tombol
                document.querySelectorAll('.btn-custom').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Tambah kelas active ke tombol yang diklik
                this.classList.add('active');
                
                // Tampilkan tabel yang sesuai
                showTable(status);
            });
        });
    });

    function showTable(status) {
        // Sembunyikan semua tabel
        document.querySelectorAll('.table-section').forEach(table => {
            table.classList.remove('active');
        });

        // Tampilkan tabel sesuai dengan status yang dipilih
        document.getElementById('tabel-' + status).classList.add('active');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Transaksi/index.blade.php ENDPATH**/ ?>