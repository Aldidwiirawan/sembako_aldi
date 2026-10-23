<html>

<head>
    <title>Cetak PDF</title>
</head>

<body>
    <style type="text/css">

    </style>

    <h4 align="center">LAPORAN PEMBELIAN <br> TOKO ALDI SEMBAKO</h4>
    <table class="table table-bordered table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php $__currentLoopData = $dataTransaksi->where('status','selesai'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $dataDetail->where('transaksi_id', $dataT->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $dataUser->where('id', $dataT->user_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataU): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $dataProduk->where('id', $dataD->produk_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataP): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($no++); ?>.</td>
                <td><?php echo e($dataT->id); ?></td>
                <td><?php echo e($dataT->user->name); ?></td>
                <td><?php echo e($dataD->produk->nama_produk); ?></td>
                <td class="text-center"><?php echo e($dataD->jumlah); ?></td>
                <td class="text-end">Rp<?php echo e(number_format($dataD->harga_satuan, 0, ',', '.')); ?></td>
                <td class="text-end">Rp<?php echo e(number_format($dataD->jumlah * $dataD->harga_satuan, 0, ',', '.')); ?></td>
                <td><?php echo e($dataD->created_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_owner/pdfLaporan.blade.php ENDPATH**/ ?>