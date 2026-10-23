
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Tambah Biaya Operasional</h3>
    <form action="<?php echo e(route('biaya-operasional.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Biaya (Rp)</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required min="0">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('biaya-operasional.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\acer\OneDrive\เอกสาร\sembako_aldi\resources\views/dashboard_owner/biaya_operasional/create.blade.php ENDPATH**/ ?>