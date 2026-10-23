

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>Tambah Data Stok Masuk</h4>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✅ Berhasil!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Gagal!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Terjadi Kesalahan:</strong>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('stok-masuk.store')); ?>" id="stokForm">
        <?php echo csrf_field(); ?>

        <!-- Form fields tetap sama -->
        <div class="mb-3">
            <label for="created_at" class="form-label">Tanggal:</label>
            <input type="date" name="created_at" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan" value="<?php echo e(old('keterangan')); ?>">
        </div>

        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" id="addRowBtn">
                ➕ Tambah Baris
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="produkTable">
                <thead class="table-success">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="produkBody">
                    <tr>
                        <td class="position-relative">
                            <input type="text" name="nama_produk[]" class="form-control nama-produk" autocomplete="off" value="<?php echo e(old('nama_produk.0')); ?>">
                            <input type="hidden" name="produk_id[]" class="produk-id" value="<?php echo e(old('produk_id.0')); ?>">
                            <div class="produk-list" style="display:none; position:absolute; z-index:1000; background:white; border:1px solid #ccc; width:100%; max-height:200px; overflow-y:auto;"></div>
                        </td>
                        <td>
                            <input type="number" name="harga[]" class="form-control harga-input" min="0" value="<?php echo e(old('harga.0')); ?>">
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control qty-input" min="1" value="<?php echo e(old('qty.0', 1)); ?>">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-btn" disabled>🗑️</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-2"></i>💾 Simpan Stok Masuk
            </button>
            <a href="<?php echo e(route('stok-masuk')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>← Kembali ke Daftar
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Script loaded!');
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // 1. TAMBAH BARIS
    document.getElementById('addRowBtn').addEventListener('click', function() {
        console.log('✅ Tombol tambah diklik');
        
        const tbody = document.getElementById('produkBody');
        const newRow = document.createElement('tr');
        
        newRow.innerHTML = `
            <td class="position-relative">
                <input type="text" name="nama_produk[]" class="form-control nama-produk" autocomplete="off">
                <input type="hidden" name="produk_id[]" class="produk-id">
                <div class="produk-list" style="display:none; position:absolute; z-index:1000; background:white; border:1px solid #ccc; width:100%; max-height:200px; overflow-y:auto;"></div>
            </td>
            <td><input type="number" name="harga[]" class="form-control harga-input" min="0"></td>
            <td><input type="number" name="qty[]" class="form-control qty-input" min="1" value="1"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-btn">🗑️</button></td>
        `;
        
        tbody.appendChild(newRow);
        updateRemoveButtons();
        console.log('✅ Baris baru ditambahkan');
    });

    // 2. HAPUS BARIS
    document.getElementById('produkBody').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-btn')) {
            console.log('✅ Tombol hapus diklik');
            const rows = this.querySelectorAll('tr');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                updateRemoveButtons();
                console.log('✅ Baris dihapus');
            }
        }
    });

    // 3. SEARCH PRODUK
    document.getElementById('produkBody').addEventListener('input', function(e) {
        if (e.target.classList.contains('nama-produk')) {
            const input = e.target;
            const query = input.value.trim();
            const list = input.parentNode.querySelector('.produk-list');
            
            console.log('🔍 Typing:', query);
            
            if (query.length >= 2) {
                // Show loading
                list.innerHTML = '<div class="list-group-item">Mencari...</div>';
                list.style.display = 'block';
                
                // Simple AJAX dengan fetch
                fetch(`<?php echo e(route('produk.search')); ?>?query=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        console.log('📦 Data received:', html);
                        list.innerHTML = html;
                        list.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('❌ Error:', error);
                        list.innerHTML = '<div class="list-group-item text-danger">Error saat memuat data</div>';
                        list.style.display = 'block';
                    });
            } else {
                list.style.display = 'none';
            }
        }
    });

    // 4. PILIH PRODUK
    document.getElementById('produkBody').addEventListener('click', function(e) {
        if (e.target.classList.contains('produk-item')) {
            console.log('✅ Produk dipilih:', e.target.textContent);
            
            const item = e.target;
            const row = item.closest('tr');
            const input = row.querySelector('.nama-produk');
            const hidden = row.querySelector('.produk-id');
            const hargaInput = row.querySelector('.harga-input');
            const list = row.querySelector('.produk-list');
            
            input.value = item.textContent.trim();
            hidden.value = item.dataset.id;
            
            // Set harga beli jika ada data-harga
            if (item.dataset.harga && item.dataset.harga !== '0') {
                hargaInput.value = item.dataset.harga;
            } else {
                hargaInput.value = ''; // Kosongkan jika tidak ada harga
            }
            
            list.style.display = 'none';
            hargaInput.focus();
            
            // Validasi form setelah memilih produk
            validateForm();
        }
    });

    // 5. VALIDASI FORM REAL-TIME
    function validateForm() {
        const rows = document.querySelectorAll('#produkBody tr');
        let isValid = true;
        
        rows.forEach(row => {
            const produkId = row.querySelector('.produk-id').value;
            const harga = row.querySelector('.harga-input').value;
            const qty = row.querySelector('.qty-input').value;
            
            if (!produkId || !harga || !qty) {
                isValid = false;
            }
        });
        
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = !isValid;
        }
    }

    // 6. UPDATE TOMBOL HAPUS
    function updateRemoveButtons() {
        const rows = document.querySelectorAll('#produkBody tr');
        const buttons = document.querySelectorAll('.remove-btn');
        
        buttons.forEach(btn => {
            btn.disabled = rows.length === 1;
        });
        
        console.log(`📊 Total baris: ${rows.length}`);
    }

    // Event listeners untuk validasi real-time
    document.getElementById('produkBody').addEventListener('input', function(e) {
        if (e.target.classList.contains('harga-input') || e.target.classList.contains('qty-input')) {
            validateForm();
        }
    });

    // 7. CONFIRMATION BEFORE SUBMIT
    document.getElementById('stokForm').addEventListener('submit', function(e) {
        const rows = document.querySelectorAll('#produkBody tr');
        let totalItems = 0;
        
        rows.forEach(row => {
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            totalItems += qty;
        });
        
        if (!confirm(`Anda akan menambahkan ${totalItems} item stok masuk. Lanjutkan?`)) {
            e.preventDefault();
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
            submitBtn.disabled = true;
        }
    });

    // Init
    updateRemoveButtons();
    validateForm();
});
</script>

<style>
.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.btn-success {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    font-weight: 600;
}

.btn-success:hover {
    background: linear-gradient(135deg, #218838, #1e9e8a);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.table th {
    background-color: #198754 !important;
    color: white;
    font-weight: 600;
}

.position-relative {
    min-width: 250px;
}

.produk-list {
    border-radius: 5px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.produk-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}

.remove-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/dashboard_admin/Produk/formStok.blade.php ENDPATH**/ ?>