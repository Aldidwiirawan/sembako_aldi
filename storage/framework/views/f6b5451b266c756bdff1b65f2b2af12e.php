

<?php $__env->startSection('title', 'Tambah Produk - Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-success mb-1">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Produk Baru
                        </h2>
                        <p class="text-muted mb-0">Tambahkan produk baru ke dalam sistem inventory</p>
                    </div>
                    <a href="<?php echo e(url('tampil-produk')); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-box-seam me-2"></i>Form Tambah Produk
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data" id="produkForm">
                            <?php echo csrf_field(); ?>

                            
                            <div class="form-section">
                                <h6 class="text-success mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Produk
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
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
unset($__errorArgs, $__bag); ?>" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" 
                                                        <?php echo e(old('kategori') == $category->id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->nama_kategori); ?>

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
                                    </div>
                                    <div class="col-md-6">
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
                                                value="<?php echo e(old('nama_produk')); ?>" 
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
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            
                            <div class="form-section">
                                <h6 class="text-success mb-3">
                                    <i class="bi bi-currency-dollar me-2"></i>Harga & Stok
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-4">
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
                                                    value="<?php echo e(old('harga_kolak')); ?>" 
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
                                    </div>
                                    <div class="col-md-4">
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
                                                    value="<?php echo e(old('harga_jual')); ?>" 
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="stok" class="form-label">
                                                Stok Awal <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="stok" id="stok" 
                                                class="form-control <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                value="<?php echo e(old('stok', 0)); ?>" 
                                                placeholder="0" min="0" required>
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
                                            <small class="text-muted">Jumlah stok awal produk</small>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-info" id="labaAlert" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Laba per Unit:</strong>
                                                    <span id="labaSatuan" class="fw-bold text-success">Rp 0</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Margin:</strong>
                                                    <span id="margin" class="fw-bold text-success">0%</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Total Laba:</strong>
                                                    <span id="totalLaba" class="fw-bold text-success">Rp 0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            
                            <div class="form-section">
                                <h6 class="text-success mb-3">
                                    <i class="bi bi-image me-2"></i>Gambar Produk
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Upload Gambar</label>
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
                                                Format: JPG, PNG, JPEG. Maksimal 2MB. Rekomendasi rasio 1:1
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="image-preview">
                                            <div id="imagePreview" class="image-preview-container">
                                                <i class="bi bi-image text-muted"></i>
                                                <span>Preview Gambar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <a href="<?php echo e(url('tampil-produk')); ?>" class="btn btn-outline-danger">
                                            <i class="bi bi-x-circle me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-success" id="submitBtn">
                                            <i class="bi bi-check-circle me-2"></i>Simpan Produk
                                        </button>
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
        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #dee2e6;
            z-index: 1;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .step.active .step-number {
            background-color: #198754;
            color: white;
        }
        
        .step-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-align: center;
        }
        
        .step.active .step-label {
            color: #198754;
            font-weight: 500;
        }
        
        .image-preview-container {
            width: 100%;
            height: 150px;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            overflow: hidden;
        }
        
        .image-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .form-section {
            padding: 1rem 0;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Image preview
            $('#foto').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').html(
                            `<img src="${e.target.result}" alt="Preview" class="img-fluid">`
                        );
                    }
                    reader.readAsDataURL(file);
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
                    $('#totalLaba').text('Rp ' + totalLaba.toLocaleString('id-ID'));
                    
                    // Show/hide alert based on profit
                    if (labaSatuan >= 0) {
                        $('#labaAlert').show();
                    } else {
                        $('#labaAlert').hide();
                    }
                } else {
                    $('#labaAlert').hide();
                }
            }

            // Event listeners for profit calculation
            $('#harga_kolak, #harga_jual, #stok').on('input', calculateProfit);

            // Form validation
            $('#produkForm').on('submit', function(e) {
                const hargaModal = parseInt($('#harga_kolak').val()) || 0;
                const hargaJual = parseInt($('#harga_jual').val()) || 0;

                if (hargaJual <= hargaModal) {
                    if (!confirm('Harga jual sama atau lebih rendah dari harga modal. Apakah Anda yakin ingin melanjutkan?')) {
                        e.preventDefault();
                        return false;
                    }
                }

                // Show loading state
                $('#submitBtn').prop('disabled', true).html(
                    '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...'
                );
            });

            // Auto format number inputs
            $('input[type="number"]').on('blur', function() {
                const value = parseInt($(this).val()) || 0;
                $(this).val(value);
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Produk/create.blade.php ENDPATH**/ ?>