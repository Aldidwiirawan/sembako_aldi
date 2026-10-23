
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Daftar Gaji Pegawai</h3>
    <a href="<?php echo e(route('gaji-pegawai.create')); ?>" class="btn btn-primary mb-3">Tambah Gaji</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Admin</th>
                <th>Gaji per Bulan</th>
                <th>Total per Bulan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i+1); ?></td>
                <td><?php echo e($item->nama_admin); ?></td>
                <td>Rp <?php echo e(number_format($item->gaji_per_bulan,0,',','.')); ?></td>
                <td>Rp <?php echo e(number_format($item->total_per_bulan,0,',','.')); ?></td>
                <td><?php echo e($item->tanggal); ?></td>
                <td>
                    <a href="<?php echo e(route('gaji-pegawai.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('gaji-pegawai.destroy', $item->id)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/dashboard_owner/gaji_pegawai/index.blade.php ENDPATH**/ ?>