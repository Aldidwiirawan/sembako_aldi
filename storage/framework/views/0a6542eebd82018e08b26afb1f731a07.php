<html>

<head>
    <title>Cetak PDF</title>
</head>

<body>
    <style type="text/css">

    </style>

    <h4 align="center">Laporan Ongkir <br> TOKO ALDI SEMBAKO</h4>
    <div class="table-container" style="display:flex; justify-content: center;">
        <table class="table table-bordered table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Biaya Ongkir</th>
                    <th>Tanggal Kirim</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php $__currentLoopData = $dataTransaksi->where('status','selesai'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($no++); ?></td>
                    <td><?php echo e($dataT->id); ?></td>
                    <td><?php echo e($dataT->user->name); ?></td>
                    <td>Rp<?php echo e(number_format(16000, 0, ',', '.')); ?></td>
                    <td><?php echo e($dataT->updated_at->format('d-m-Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>


    <script type="text/javascript">
        window.print();
    </script>
</body>

</html><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_owner/pdfLaporanOngkir.blade.php ENDPATH**/ ?>