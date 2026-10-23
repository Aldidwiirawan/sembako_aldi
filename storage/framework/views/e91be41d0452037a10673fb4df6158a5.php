

<?php $__env->startSection('content'); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .sidebar-link:hover {
            background-color: white !important;
            color: #198754 !important;
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

        .btn-custom {
            border: 2px solid #198754;
            color: #198754;
            transition: all 0.3s ease;
        }

        .btn-custom:hover,
        .btn-custom:active,
        .btn-custom:focus {
            background-color: #198754 !important;
            color: white !important;
            border-color: #198754 !important;
        }

        .chart-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            color: #198754;
            font-weight: 600;
        }

        .filter-btn {
            background-color: #e9f5ef;
            color: #198754;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: #198754;
            color: white;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .summary-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #198754;
        }
        
        .summary-value.profit {
            color: #198754;
        }
        
        .summary-value.loss {
            color: #dc3545;
        }

        .summary-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .rotate {
            transition: transform 0.3s ease;
        }

        .rotate.down {
            transform: rotate(180deg);
        }

        .card-header {
            background-color: #198754;
            color: white;
            font-weight: 600;
        }

        .period-selector {
            background-color: #e9f5ef;
            border-radius: 8px;
            padding: 10px;
        }
        
        .profit-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #198754;
            position: relative;
        }
        
        .profit-title {
            color: #198754;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .profit-detail {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .profit-detail:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .profit-label {
            font-weight: 500;
            color: #495057;
        }
        
        .profit-amount {
            font-weight: 600;
            color: #198754;
        }
        
        .profit-amount.negative {
            color: #dc3545;
        }
        
        .cost-item {
            padding-left: 20px;
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .edit-form {
            display: none;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }
        
        .editable-field {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .editable-field:hover {
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        
        .edit-input {
            width: 100%;
            padding: 5px 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            text-align: right;
            font-weight: 600;
        }
    </style>
</head>

    <!-- Main Content -->
    <div class="">
        <div class="flex-grow-1 p-4">
            <!-- Card Ringkasan -->
            <div class="row mb-4 justify-content-center">
                <div class="col-md-3">
                    <div class="summary-card text-center">
                        <div class="summary-value">Rp<?php echo e(number_format($pendapatanBulanIni, 0, ',', '.')); ?></div>
                        <div class="summary-label">Pendapatan Bulan Ini</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card text-center">
                        <div class="summary-value"><?php echo e($totalTransaksi); ?></div>
                        <div class="summary-label">Total Transaksi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="summary-card text-center">
                        <div class="summary-value"><?php echo e($produkTerjual); ?></div>
                        <div class="summary-label">Produk Terjual</div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pendapatan -->
            <div class="chart-container">
                <div class="chart-header">
                    <h4 class="chart-title">Grafik Pendapatan</h4>
                    <div class="period-selector">
                        <button class="filter-btn active" data-period="daily">Harian</button>
                        <button class="filter-btn" data-period="weekly">Mingguan</button>
                        <button class="filter-btn" data-period="monthly">Bulanan</button>
                    </div>
                </div>
                <canvas id="pendapatanChart"></canvas>
            </div>
            
            <!-- Detail Keuntungan -->
            <div class="profit-section">
                <h4 class="profit-title">
                    <span>Detail Keuntungan Bulan Ini</span>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit-operasional">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </button>
                </h4>
                
                
                <div class="profit-detail">
                    <div class="d-flex justify-content-between">
                        <span class="profit-label">Pendapatan Bulan Ini:</span>
                        <?php
                            $keuntunganKotor = $pendapatanBulanIni;
                        ?>
                        <span class="profit-amount <?php echo e($keuntunganKotor >= 0 ? '' : 'negative'); ?>" id="keuntunganKotorDisplay">
                            Rp<?php echo e(number_format(abs($keuntunganKotor), 0, ',', '.')); ?>

                        </span>
                    </div>
                </div>
                
                <div class="profit-detail">
                    <div class="profit-label mb-2">Biaya Operasional:</div>
                        <div class="cost-item">
                            <?php
                                $biaya_operasional_admin = $keuntunganKotor * 0.20;
                            ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Biaya Admin</span>
                                <span class="">Rp<?php echo e(number_format($biaya_operasional_admin, 0, ',', '.')); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Biaya Toko</span>
                                <span class="editable-field">Rp<?php echo e(number_format($biaya_operasional_toko->biaya, 0, ',', '.')); ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Biaya Urgent</span>
                                <span class="editable-field">Rp<?php echo e(number_format($biaya_operasional_urgent->biaya, 0, ',', '.')); ?></span>
                            </div>
                            <div class="edit-form">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control">
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-sm btn-secondary btn-cancel">Batal</button>
                                    <button class="btn btn-sm btn-primary btn-save">Simpan</button>
                                </div>
                            </div>
                        </div>
                    <div class="d-flex justify-content-between mt-2">
                        <?php
                            $totalBiayaOperasional = $biaya_operasional_admin + $biaya_operasional_toko->biaya + $biaya_operasional_urgent->biaya;
                        ?>
                        <span class="profit-label">Total Biaya Operasional:</span>
                        <span class="profit-amount" id="totalBiayaDisplay">Rp<?php echo e(number_format($totalBiayaOperasional, 0, ',', '.')); ?></span>
                    </div>
                </div>
                
                <div class="profit-detail">
                    <div class="d-flex justify-content-between">
                        <span class="profit-label">Keuntungan Bersih:</span>
                        <?php
                            $keuntunganBersih = $keuntunganKotor - $totalBiayaOperasional;
                        ?>
                        <span class="profit-amount <?php echo e($keuntunganBersih >= 0 ? '' : 'negative'); ?>" id="keuntunganBersihDisplay">
                            Rp<?php echo e(number_format(abs($keuntunganBersih), 0, ',', '.')); ?>

                        </span>
                    </div>
                </div>
            </div>

            <!-- pencarian berdasarkan tanggal -->
            <div class="card mb-4">
                <div class="card-header">
                    Filter Laporan
                </div>
                <div class="card-body">
                    <div class="mb-3 d-flex">
                        <form action="<?php echo e(route('laporan.cari')); ?>" method="GET" class="d-flex w-100">
                            <input type="date" name="tanggal_mulai" class="form-control me-2" value="2025-07-01">
                            <span class="align-self-center me-2">sampai</span>
                            <input type="date" name="tanggal_akhir" class="form-control me-2" value="2025-07-24">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="<?php echo e(route('laporan')); ?>" class="btn btn-outline-secondary ms-2">Reset</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- export -->
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <a href="<?php echo e(route('laporan.pdf')); ?>" class="btn btn-outline-danger me-2">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                    </a>
                    <a href="<?php echo e(route('laporan.excel')); ?>" class="btn btn-outline-success me-2">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </a>
                    <a href="<?php echo e(route('laporan.produkTerlaris')); ?>" class="btn btn-outline-danger me-2">
                        <i class="bi bi-trophy me-1"></i> Produk Terlaris
                    </a>
                    <a href="<?php echo e(route('laporan.ongkir')); ?>" class="btn btn-outline-success">
                        <i class="bi bi-truck me-1"></i> Laporan Ongkir
                    </a>
                </div>
                <div>
                    <select class="form-select">
                        <option>10 entri</option>
                        <option>25 entri</option>
                        <option>50 entri</option>
                        <option>100 entri</option>
                    </select>
                </div>
            </div>

            <!-- Tabel Laporan -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Harga Pokok</th>
                            <th>Keuntungan</th>
                            <th>Subtotal</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1; 
                            $totalKeuntungan = 0;
                        ?>
                        <?php $__currentLoopData = $dataDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $transaksi = $dataTransaksi->where('id', $detail->transaksi_id)->first();
                                $user = $dataUser->where('id', $transaksi->user_id ?? null)->first();
                                $produkItem = $dataProduk->where('id', $detail->produk_id)->first();
                                $hargaSatuan = $detail->harga_satuan ?? 0;
                                $hargaPokok = $produkItem->harga_pokok ?? ($hargaSatuan * 0.6); // Data dummy: 60% dari harga jual
                                $keuntunganPerItem = ($hargaSatuan - $hargaPokok) * $detail->jumlah;
                                $totalKeuntungan += $keuntunganPerItem;
                                $subtotal = $detail->subtotal ?? $detail->jumlah * $hargaSatuan;
                            ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($transaksi->id ?? '-'); ?></td>
                                <td><?php echo e($user->name ?? '-'); ?></td>
                                <td><?php echo e($produkItem->nama_produk ?? '-'); ?></td>
                                <td><?php echo e($detail->jumlah); ?></td>
                                <td>Rp<?php echo e(number_format($hargaSatuan, 0, ',', '.')); ?></td>
                                <td>Rp<?php echo e(number_format($hargaPokok, 0, ',', '.')); ?></td>
                                <td class="<?php echo e($keuntunganPerItem >= 0 ? 'text-success' : 'text-danger'); ?>">
                                    Rp<?php echo e(number_format(abs($keuntunganPerItem), 0, ',', '.')); ?>

                                </td>
                                <td>Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                                <td><?php echo e($transaksi->created_at ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-secondary fw-bold">
                            <td colspan="7" class="text-end">Total Keuntungan:</td>
                            <td class="<?php echo e($totalKeuntungan >= 0 ? 'text-success' : 'text-danger'); ?>">
                                Rp<?php echo e(number_format(abs($totalKeuntungan), 0, ',', '.')); ?>

                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-between">
                    <li class="page-item">
                        <span class="page-link">Menampilkan <?php echo e($dataDetail->firstItem()); ?> sampai
                            <?php echo e($dataDetail->lastItem()); ?> dari <?php echo e($dataDetail->total()); ?> entri</span>
                    </li>
                    <div class="d-flex">
                        <?php if($dataDetail->onFirstPage()): ?>
                            <li class="page-item disabled">
                                <span class="page-link">Sebelumnya</span>
                            </li>
                        <?php else: ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo e($dataDetail->previousPageUrl()); ?>">Sebelumnya</a>
                            </li>
                        <?php endif; ?>

                        <?php $__currentLoopData = $dataDetail->getUrlRange(1, $dataDetail->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item <?php echo e($dataDetail->currentPage() == $page ? 'active' : ''); ?>">
                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($dataDetail->hasMorePages()): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo e($dataDetail->nextPageUrl()); ?>">Berikutnya</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">Berikutnya</span>
                            </li>
                        <?php endif; ?>
                    </div>
                </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="edit-operasional" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('laporan.operasioanl.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                    <div class="modal-body">
                        <div class="item">
                            <label for="">Biaya Toko</label>
                            <input type="text" class="form-control" name="toko" value="<?php echo e($biaya_operasional_toko->biaya); ?>">
                        </div>
                        <div class="item">
                            <label for="">Biaya Urgent</label>
                            <input type="text" class="form-control" name="urgent" value="<?php echo e($biaya_operasional_urgent->biaya); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Data untuk grafik
        const chartData = <?php echo json_encode($chartData, 15, 512) ?>;

        const dailyData = {
            labels: chartData.daily.labels,
            datasets: [{
                label: 'Pendapatan Harian',
                data: chartData.daily.data,
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        };

        const weeklyData = {
            labels: chartData.weekly.labels,
            datasets: [{
                label: 'Pendapatan Mingguan',
                data: chartData.weekly.data,
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        };

        const monthlyData = {
            labels: chartData.monthly.labels,
            datasets: [{
                label: 'Pendapatan Bulanan',
                data: chartData.monthly.data,
                backgroundColor: 'rgba(25, 135, 84, 0.2)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        };

        // Konfigurasi grafik
        const ctx = document.getElementById('pendapatanChart').getContext('2d');
        const pendapatanChart = new Chart(ctx, {
            type: 'line',
            data: dailyData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        padding: 10,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return `Rp${context.parsed.y.toLocaleString('id-ID')}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Filter grafik
        $('.filter-btn').click(function() {
            const period = $(this).data('period');

            // Update button active state
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Update chart data
            switch (period) {
                case 'daily':
                    pendapatanChart.data = dailyData;
                    pendapatanChart.options.scales.y.ticks.callback = function(value) {
                        return 'Rp' + value.toLocaleString('id-ID');
                    };
                    break;
                case 'weekly':
                    pendapatanChart.data = weeklyData;
                    pendapatanChart.options.scales.y.ticks.callback = function(value) {
                        return 'Rp' + value.toLocaleString('id-ID');
                    };
                    break;
                case 'monthly':
                    pendapatanChart.data = monthlyData;
                    pendapatanChart.options.scales.y.ticks.callback = function(value) {
                        return 'Rp' + (value / 1000000).toLocaleString('id-ID', {
                            maximumFractionDigits: 1
                        }) + ' jt';
                    };
                    break;
            }

            pendapatanChart.update();
        });

        // Fungsi untuk mengelola edit data keuntungan
        $(document).ready(function() {
            let isEditing = false;
            const originalValues = {};
            
            // Toggle mode edit
            $('#toggleEditProfit').click(function() {
                isEditing = !isEditing;
                
                if (isEditing) {
                    $(this).html('<i class="bi bi-eye me-1"></i> Lihat');
                    $(this).removeClass('btn-outline-primary').addClass('btn-outline-secondary');
                    $('.editable-field').show();
                    $('.edit-form').hide();
                } else {
                    $(this).html('<i class="bi bi-pencil me-1"></i> Edit');
                    $(this).removeClass('btn-outline-secondary').addClass('btn-outline-primary');
                    $('.editable-field').show();
                    $('.edit-form').hide();
                }
            });
            
            // Klik field untuk edit
            $('.editable-field').click(function() {
                if (!isEditing) return;
                
                const field = $(this).data('field');
                $(this).hide();
                $(`.edit-form[data-field="${field}"]`).show();
            });
            
            // Batal edit
            $('.btn-cancel').click(function() {
                const form = $(this).closest('.edit-form');
                const field = form.data('field');
                const input = form.find('input');
                
                // Kembalikan nilai original
                input.val(input.data('original'));
                
                form.hide();
                $(`.editable-field[data-field="${field}"]`).show();
            });
            
            // Simpan perubahan
            $('.btn-save').click(function() {
                const form = $(this).closest('.edit-form');
                const field = form.data('field');
                const input = form.find('input');
                const newValue = parseInt(input.val()) || 0;
                
                // Update tampilan
                $(`.editable-field[data-field="${field}"]`).text('Rp' + newValue.toLocaleString('id-ID'));
                
                // Simpan nilai baru
                input.data('original', newValue);
                
                form.hide();
                $(`.editable-field[data-field="${field}"]`).show();
                
                // Hitung ulang semua nilai
                calculateProfit();
            });
            
            // Fungsi untuk menghitung ulang keuntungan
            function calculateProfit() {
                // Ambil nilai terbaru
                const pendapatanKotor = parseInt($('input[data-field="pendapatanKotor"]').val()) || 0;
                const hpp = parseInt($('input[data-field="hpp"]').val()) || 0;
                const gaji = parseInt($('input[data-field="biaya-gaji"]').val()) || 0;
                const toko = parseInt($('input[data-field="biaya-toko"]').val()) || 0;
                const urgent = parseInt($('input[data-field="biaya-urgent"]').val()) || 0;
                
                // Hitung keuntungan kotor
                const keuntunganKotor = pendapatanKotor - hpp;
                $('#keuntunganKotorDisplay').text('Rp' + Math.abs(keuntunganKotor).toLocaleString('id-ID'));
                if (keuntunganKotor < 0) {
                    $('#keuntunganKotorDisplay').addClass('negative');
                } else {
                    $('#keuntunganKotorDisplay').removeClass('negative');
                }
                
                // Hitung total biaya operasional
                const totalBiaya = gaji + toko + urgent;
                $('#totalBiayaDisplay').text('Rp' + totalBiaya.toLocaleString('id-ID'));
                
                // Hitung keuntungan bersih
                const keuntunganBersih = keuntunganKotor - totalBiaya;
                $('#keuntunganBersihDisplay').text('Rp' + Math.abs(keuntunganBersih).toLocaleString('id-ID'));
                if (keuntunganBersih < 0) {
                    $('#keuntunganBersihDisplay').addClass('negative');
                } else {
                    $('#keuntunganBersihDisplay').removeClass('negative');
                }
                
                // Update card ringkasan
                $('.summary-card:last .summary-value').text('Rp' + Math.abs(keuntunganBersih).toLocaleString('id-ID'));
                if (keuntunganBersih < 0) {
                    $('.summary-card:last .summary-value').addClass('loss').removeClass('profit');
                } else {
                    $('.summary-card:last .summary-value').addClass('profit').removeClass('loss');
                }
            }
            
            // Inisialisasi nilai original
            $('input').each(function() {
                $(this).data('original', $(this).val());
            });
        });
    </script>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.owner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_owner/laporan.blade.php ENDPATH**/ ?>