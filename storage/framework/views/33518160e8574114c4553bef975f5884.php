

<?php $__env->startSection('content'); ?>


<div class="container mt-4">
    <a href="<?php echo e(route('laporan')); ?>" class="btn btn-danger mb-3">Kembali</a>
    <div class="card shadow rounded-4">
        <div class="card-header bg-success text-white rounded-top-4">
            <h4 class="mb-0 text-center"><i class="bi bi-star-fill me-2"></i>10 Produk Paling Laris</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle table-hover">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $produkInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="badge bg-primary"><?php echo e($index + 1); ?></span></td>
                                <td><?php echo e($produk['nama_produk']); ?></td>
                                <td>
                                    <span class="badge bg-success">
                                        <?php echo e($produk['total_terjual']); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/dashboard_owner/produk-terlaris.blade.php ENDPATH**/ ?>