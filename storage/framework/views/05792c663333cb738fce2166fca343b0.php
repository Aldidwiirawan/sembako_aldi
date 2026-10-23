

<?php $__env->startSection('title', 'Edit Produk - Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-warning mb-1">
                            <i class="bi bi-pencil-square me-2"></i>Edit Produk
                        </h2>
                        <p class="text-muted mb-0">Edit data produk <?php echo e($data->nama_produk); ?></p>
                        <div class="mt-2">
                            <span class="badge bg-secondary">Kode: <?php echo e($data->id); ?></span>
                            <span class="badge bg-info text-dark ms-2">Kategori: <?php echo e($data->kategori->nama_kategori); ?></span>
                            <?php if($data->stok == 0): ?>
                                <span class="badge bg-danger ms-2">Stok Habis</span>
                            <?php elseif($data->stok <= 10): ?>
                                <span class="badge bg-warning text-dark ms-2">Stok Sedikit</span>
                            <?php else: ?>
                                <span class="badge bg-success ms-2">Stok: <?php echo e($data->stok); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?php echo e(url('tampil-produk')); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-box-seam me-2"></i>Form Edit Produk
                        </h5>
                    </div>
                    <div class="card-body">
                        
                        <form action="<?php echo e(route('produk.update', $data->id)); ?>" method="POST" enctype="multipart/form-data" id="produkForm">
                            <?php echo csrf_field(); ?>
                            
                            
                            

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <h6 class="text-warning mb-3">
                                            <i class="bi bi-info-circle me-2"></i>Informasi Produk
                                        </h6>
                                        
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">
                                                Kategori <span class="text-danger">*</span>
                                            </label>
                                            <select name="kategori" class="form-select <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php $__currentLoopData = $kat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cat->id); ?>" 
                                                        <?php echo e($cat->id == $data->kategori_id ? 'selected' : ''); ?>

                                                        <?php echo e(old('kategori') == $cat->id ? 'selected' : ''); ?>>
                                                        <?php echo e($cat->nama_kategori); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama_produk" class="form-label">
                                                Nama Produk <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="nama_produk" id="nama_produk" 
                                                class="form-control <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                value="<?php echo e(old('nama_produk', $data->nama_produk)); ?>" 
                                                placeholder="Masukkan nama produk" required>
                                            <?php $__errorArgs = ['nama_produk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="stok" class="form-label">
                                                Stok Saat Ini
                                            </label>
                                            <div class="input-group">
                                                <input type="number" name="stok" id="stok" 
                                                    class="form-control <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('stok', $data->stok)); ?>" 
                                                    placeholder="0" min="0" readonly
                                                    style="background-color: #f8f9fa;">
                                                <span class="input-group-text bg-light">
                                                    <i class="bi bi-info-circle text-muted" 
                                                       data-bs-toggle="tooltip" 
                                                       data-bs-title="Stok hanya dapat diubah melalui menu stok masuk/keluar"></i>
                                                </span>
                                            </div>
                                            <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <small class="text-muted">Untuk mengubah stok, gunakan menu Stok Masuk/Stok Keluar</small>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    
                                    <div class="form-section">
                                        <h6 class="text-warning mb-3">
                                            <i class="bi bi-currency-dollar me-2"></i>Informasi Harga
                                        </h6>
                                        
                                        <div class="mb-3">
                                            <label for="harga_kolak" class="form-label">
                                                Harga Modal <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control <?php $__errorArgs = ['harga_kolak'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                    id="harga_kolak" name="harga_kolak"
                                                    value="<?php echo e(old('harga_kolak', $data->harga_kolak)); ?>" 
                                                    placeholder="0" min="0" required>
                                            </div>
                                            <?php $__errorArgs = ['harga_kolak'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <small class="text-muted">Harga beli dari supplier</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_jual" class="form-label">
                                                Harga Jual <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                    id="harga_jual" name="harga_jual"
                                                    value="<?php echo e(old('harga_jual', $data->harga_jual)); ?>" 
                                                    placeholder="0" min="0" required>
                                            </div>
                                            <?php $__errorArgs = ['harga_jual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <small class="text-muted">Harga jual ke customer</small>
                                        </div>

                                        
                                        <div class="alert alert-info" id="labaAlert">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <small>Laba per Unit</small>
                                                    <div id="labaSatuan" class="fw-bold text-success fs-6">Rp 0</div>
                                                </div>
                                                <div class="col-6">
                                                    <small>Margin</small>
                                                    <div id="margin" class="fw-bold text-success fs-6">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-section mt-4">
                                        <h6 class="text-warning mb-3">
                                            <i class="bi bi-image me-2"></i>Gambar Produk
                                        </h6>
                                        
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Upload Gambar Baru</label>
                                            <input type="file" name="foto" id="foto" 
                                                class="form-control <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                accept="image/*">
                                            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <small class="text-muted">
                                                Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, JPEG. Maksimal 2MB
                                            </small>
                                        </div>

                                        
                                        <div class="current-image mb-3">
                                            <label class="form-label">Gambar Saat Ini</label>
                                            <div class="image-preview-container">
                                                <?php if($data->foto): ?>
                                                    <img src="<?php echo e(asset($data->foto)); ?>" 
                                                         alt="<?php echo e($data->nama_produk); ?>" 
                                                         class="img-fluid rounded border"
                                                         style="max-height: 200px;">
                                                    <div class="mt-2">
                                                        <small class="text-muted">
                                                            <i class="bi bi-info-circle me-1"></i>
                                                            Gambar akan diganti jika upload file baru
                                                        </small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="text-center text-muted py-4">
                                                        <i class="bi bi-image display-4 d-block mb-2"></i>
                                                        <span>Tidak ada gambar</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        
                                        <div class="new-image-preview mb-3" id="newImagePreview" style="display: none;">
                                            <label class="form-label">Preview Gambar Baru</label>
                                            <div class="image-preview-container">
                                                <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded border" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card border-warning">
                                        <div class="card-body">
                                            <h6 class="card-title text-warning mb-3">
                                                <i class="bi bi-graph-up me-2"></i>Ringkasan Perubahan
                                            </h6>
                                            <div class="row text-center">
                                                <div class="col-md-3">
                                                    <small class="text-muted">Harga Modal</small>
                                                    <div class="fw-bold" id="summaryModal">Rp <?php echo e(number_format($data->harga_kolak, 0, ',', '.')); ?></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="text-muted">Harga Jual</small>
                                                    <div class="fw-bold" id="summaryJual">Rp <?php echo e(number_format($data->harga_jual, 0, ',', '.')); ?></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="text-muted">Laba/Unit</small>
                                                    <div class="fw-bold text-success" id="summaryLaba">
                                                        Rp <?php echo e(number_format($data->harga_jual - $data->harga_kolak, 0, ',', '.')); ?>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="text-muted">Total Potensi Laba</small>
                                                    <div class="fw-bold text-success" id="summaryTotalLaba">
                                                        Rp <?php echo e(number_format(($data->harga_jual - $data->harga_kolak) * $data->stok, 0, ',', '.')); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="<?php echo e(url('tampil-produk')); ?>" class="btn btn-outline-danger">
                                                <i class="bi bi-x-circle me-2"></i>Batal
                                            </a>
                                            <button type="button" class="btn btn-outline-secondary ms-2" id="resetForm">
                                                <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-warning" id="submitBtn">
                                                <i class="bi bi-check-circle me-2"></i>Update Produk
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .form-section {
            padding: 1rem 0;
        }
        
        .image-preview-container {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            background-color: #f8f9fa;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
        }
        
        .current-image img, .new-image-preview img {
            max-width: 100%;
            height: auto;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Image preview for new upload
            $('#foto').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result);
                        $('#newImagePreview').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#newImagePreview').hide();
                }
            });

            // Calculate profit
            function calculateProfit() {
                const hargaModal = parseInt($('#harga_kolak').val()) || 0;
                const hargaJual = parseInt($('#harga_jual').val()) || 0;
                const stok = parseInt($('#stok').val()) || 0;

                if (hargaModal > 0 && hargaJual > 0) {
                    const labaSatuan = hargaJual - hargaModal;
                    const margin = ((labaSatuan / hargaModal) * 100).toFixed(1);
                    const totalLaba = labaSatuan * stok;

                    $('#labaSatuan').text('Rp ' + labaSatuan.toLocaleString('id-ID'));
                    $('#margin').text(margin + '%');
                    
                    // Update summary
                    $('#summaryModal').text('Rp ' + hargaModal.toLocaleString('id-ID'));
                    $('#summaryJual').text('Rp ' + hargaJual.toLocaleString('id-ID'));
                    $('#summaryLaba').text('Rp ' + labaSatuan.toLocaleString('id-ID'));
                    $('#summaryTotalLaba').text('Rp ' + totalLaba.toLocaleString('id-ID'));

                    // Style based on profit
                    if (labaSatuan < 0) {
                        $('#labaSatuan, #summaryLaba').removeClass('text-success').addClass('text-danger');
                        $('#margin').removeClass('text-success').addClass('text-danger');
                    } else {
                        $('#labaSatuan, #summaryLaba').removeClass('text-danger').addClass('text-success');
                        $('#margin').removeClass('text-danger').addClass('text-success');
                    }
                }
            }

            // Event listeners for profit calculation
            $('#harga_kolak, #harga_jual').on('input', calculateProfit);

            // Initial calculation
            calculateProfit();

            // Form validation
            $('#produkForm').on('submit', function(e) {
                const hargaModal = parseInt($('#harga_kolak').val()) || 0;
                const hargaJual = parseInt($('#harga_jual').val()) || 0;

                if (hargaJual <= hargaModal) {
                    if (!confirm('Harga jual sama atau lebih rendah dari harga modal. Ini akan mengakibatkan kerugian. Apakah Anda yakin ingin melanjutkan?')) {
                        e.preventDefault();
                        return false;
                    }
                }

                // Show loading state
                $('#submitBtn').prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Memperbarui...'
                );
            });

            // Reset form
            $('#resetForm').on('click', function() {
                if (confirm('Apakah Anda yakin ingin mengembalikan semua perubahan?')) {
                    // Reset to original values
                    $('#harga_kolak').val(<?php echo e($data->harga_kolak); ?>);
                    $('#harga_jual').val(<?php echo e($data->harga_jual); ?>);
                    $('#nama_produk').val('<?php echo e($data->nama_produk); ?>');
                    $('#kategori').val('<?php echo e($data->kategori_id); ?>');
                    $('#foto').val('');
                    $('#newImagePreview').hide();
                    
                    // Recalculate profit
                    calculateProfit();
                    
                    // Show success message
                    const toast = document.createElement('div');
                    toast.className = 'alert alert-success alert-dismissible fade show';
                    toast.innerHTML = `
                        <i class="bi bi-check-circle me-2"></i>Form berhasil direset ke nilai semula
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    $('#produkForm').prepend(toast);
                }
            });

            // Auto format number inputs
            $('input[type="number"]').on('blur', function() {
                const value = parseInt($(this).val()) || 0;
                $(this).val(value);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Produk/edit.blade.php ENDPATH**/ ?>