
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Tambah Gaji Pegawai</h3>
    <form action="<?php echo e(route('gaji-pegawai.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="nama_admin" class="form-label">Nama Admin</label>
            <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
        </div>
        <div class="mb-3">
            <label for="gaji_per_bulan" class="form-label">Gaji per Bulan (Rp)</label>
            <input type="number" class="form-control" id="gaji_per_bulan" name="gaji_per_bulan" required min="0" value="1000000">
        </div>
        <div class="mb-3">
            <label for="total_per_bulan" class="form-label">Total per Bulan (Rp)</label>
            <input type="number" class="form-control" id="total_per_bulan" name="total_per_bulan" required min="0">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('gaji-pegawai.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/dashboard_owner/gaji_pegawai/create.blade.php ENDPATH**/ ?>