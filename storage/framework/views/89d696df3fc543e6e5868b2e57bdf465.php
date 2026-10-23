

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulan Ini</h5>
                    <h3>Rp <?php echo e(number_format($pendapatan_bulan,0,',','.')); ?></h3>
                    <small>Pertumbuhan: <?php echo e($growth_bulan); ?>%</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Keuntungan Kotor</h5>
                    <h3>Rp <?php echo e(number_format($keuntungan_kotor,0,',','.')); ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Keuntungan Bersih</h5>
                    <h3>Rp <?php echo e(number_format($keuntungan_bersih,0,',','.')); ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <h3><?php echo e($total_transaksi); ?></h3>
                    <small>Produk Terjual: <?php echo e($produk_terjual); ?></small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Tambah Modal Awal
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('owner.modal.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah_modal" class="form-label">Jumlah Modal</label>
                        <input type="number" name="jumlah_modal" id="jumlah_modal" class="form-control" required>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            Daftar Modal Awal
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah Modal</th>
                        <th>Kulak</th>
                        <th>Operasional</th>
                        <th>Toko</th>
                        <th>Urgent</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($modal->tanggal); ?></td>
                            <td>Rp <?php echo e(number_format($modal->jumlah_modal,0,',','.')); ?></td>
                            <td>Rp <?php echo e(number_format($modal->modal_kulak,0,',','.')); ?></td>
                            <td>Rp <?php echo e(number_format($modal->biaya_operasional,0,',','.')); ?></td>
                            <td>Rp <?php echo e(number_format($modal->biaya_toko,0,',','.')); ?></td>
                            <td>Rp <?php echo e(number_format($modal->biaya_urgent,0,',','.')); ?></td>
                            <td>
                                
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($modal->id); ?>">Edit</button>
                                
                                
                                <form action="<?php echo e(route('owner.modal.destroy', $modal->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        
                        <div class="modal fade" id="editModal<?php echo e($modal->id); ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Edit Modal Awal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo e(route('owner.modal.update', $modal->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" value="<?php echo e($modal->tanggal); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_modal" class="form-label">Jumlah Modal</label>
                                        <input type="number" name="jumlah_modal" class="form-control" value="<?php echo e($modal->jumlah_modal); ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center">Belum ada data modal</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            Grafik Pendapatan & Keuntungan
        </div>
        <div class="card-body">
            <canvas id="financeChart" height="120"></canvas>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($bulan, 15, 512) ?>,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: <?php echo json_encode($pendapatan_chart, 15, 512) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Keuntungan Bersih',
                    data: <?php echo json_encode($keuntungan_chart, 15, 512) ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Laporan Keuangan Bulanan' }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.owner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\acer\OneDrive\เอกสาร\sembako_aldi\resources\views/dashboard_owner/owner.blade.php ENDPATH**/ ?>