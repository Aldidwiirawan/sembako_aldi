

<?php $__env->startSection('title', 'Edit Kategori - Aplikasi Laravel'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .card-shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    
    .btn-custom {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    
    .page-header {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }
    
    .info-card {
        border-left: 4px solid #198754;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-success mb-1">
                <i class="bi bi-pencil-square me-2"></i>Edit Kategori
            </h1>
            <p class="text-muted mb-0">Perbarui informasi kategori produk dalam sistem inventory</p>
        </div>
        <a href="<?php echo e(url('tampil-kategori')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Data Kategori
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-shadow border-0">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-tags me-2"></i>Form Edit Kategori
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo e(route('kategori.update', $data->id)); ?>" method="POST" id="editCategoryForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag text-success"></i>
                                </span>
                                <input type="text" 
                                       name="nama_kategori" 
                                       class="form-control <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="nama_kategori" 
                                       placeholder="Masukkan nama kategori"
                                       required
                                       maxlength="100"
                                       value="<?php echo e(old('nama_kategori', $data->nama_kategori)); ?>">
                            </div>
                            <div class="form-text text-muted">
                                Masukkan nama kategori yang jelas dan mudah dipahami. Maksimal 100 karakter.
                            </div>
                            <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i><?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Category Info -->
                        <div class="alert alert-info info-card">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Informasi Kategori:</strong><br>
                                    <small>Kode: <span class="badge bg-success"><?php echo e($data->id); ?></span> | 
                                    Dibuat: <?php echo e($data->created_at->format('d/m/Y')); ?> | 
                                    Diupdate: <?php echo e($data->updated_at->format('d/m/Y')); ?></small>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="<?php echo e(url('tampil-kategori')); ?>" class="btn btn-outline-danger btn-custom">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-secondary btn-custom">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success btn-custom" id="submitButton">
                                    <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                    <i class="bi bi-check-circle me-2"></i>Perbarui Kategori
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card card-shadow border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-lightbulb text-success fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold text-success mb-2">Tips Penamaan Kategori</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-muted mb-0">
                                        <li><i class="bi bi-check text-success me-2"></i>Gunakan nama yang singkat</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Hindari karakter khusus</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Konsisten dengan format</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-muted mb-0">
                                        <li><i class="bi bi-check text-success me-2"></i>Mudah dipahami</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Relevan dengan produk</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Unik dan tidak duplikat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editCategoryForm');
        const submitButton = document.getElementById('submitButton');
        const spinner = submitButton.querySelector('.spinner-border');
        const namaKategori = document.getElementById('nama_kategori');
        
        // Auto-focus pada field nama kategori
        namaKategori.focus();
        
        // Real-time validation
        namaKategori.addEventListener('input', function() {
            const value = this.value.trim();
            const errorElement = this.parentNode.parentNode.querySelector('.text-danger');
            
            if (value.length > 0) {
                this.classList.remove('is-invalid');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            }
            
            // Update character count
            updateCharacterCount(value.length);
        });
        
        // Character count functionality
        function updateCharacterCount(length) {
            let helpText = document.querySelector('.form-text');
            const maxLength = 100;
            
            if (length > maxLength * 0.8) {
                helpText.innerHTML = `Masukkan nama kategori yang jelas dan mudah dipahami. Maksimal 100 karakter. 
                                    <span class="text-warning">(${length}/${maxLength})</span>`;
            } else {
                helpText.innerHTML = 'Masukkan nama kategori yang jelas dan mudah dipahami. Maksimal 100 karakter.';
            }
        }
        
        // Initialize character count
        updateCharacterCount(namaKategori.value.length);
        
        // Form submission handler
        form.addEventListener('submit', function(e) {
            const value = namaKategori.value.trim();
            
            if (value === '') {
                e.preventDefault();
                showAlert('Nama kategori harus diisi!', 'danger');
                namaKategori.focus();
                return false;
            }
            
            if (value.length > 100) {
                e.preventDefault();
                showAlert('Nama kategori maksimal 100 karakter!', 'danger');
                namaKategori.focus();
                return false;
            }
            
            // Show loading state
            submitButton.disabled = true;
            spinner.classList.remove('d-none');
            submitButton.querySelector('i.bi-check-circle').classList.add('d-none');
        });
        
        // Alert function
        function showAlert(message, type) {
            // Remove existing alerts
            const existingAlert = document.querySelector('.alert-dismissible');
            if (existingAlert) {
                existingAlert.remove();
            }
            
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.innerHTML = `
                <i class="bi bi-exclamation-triangle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            form.prepend(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }
        
        // Reset form handler
        form.addEventListener('reset', function() {
            // Reset to original value
            namaKategori.value = "<?php echo e($data->nama_kategori); ?>";
            updateCharacterCount(namaKategori.value.length);
            
            // Clear validation states
            namaKategori.classList.remove('is-invalid');
            const errorElement = namaKategori.parentNode.parentNode.querySelector('.text-danger');
            if (errorElement) {
                errorElement.style.display = 'none';
            }
            
            // Remove alerts
            const existingAlert = document.querySelector('.alert-dismissible');
            if (existingAlert) {
                existingAlert.remove();
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Kategori/edit.blade.php ENDPATH**/ ?>