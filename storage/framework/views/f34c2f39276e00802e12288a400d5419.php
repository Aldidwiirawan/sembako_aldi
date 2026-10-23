

<?php $__env->startSection('title', 'Detail Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/order')); ?>" class="text-decoration-none text-muted hover-text-primary">
                    <i class="fas fa-home me-1"></i>Beranda
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">
                <?php echo e($product->nama_produk); ?>

            </li>
        </ol>
    </nav>

    <div class="row g-5">
        
        <div class="col-lg-6">
            <div class="product-image-container position-relative">
                <div class="main-image bg-light rounded-4 overflow-hidden shadow-sm position-relative">
                    <img src="<?php echo e(asset($product->foto)); ?>" 
                         class="img-fluid w-100 product-main-image" 
                         alt="<?php echo e($product->nama_produk); ?>"
                         style="height: 500px; object-fit: cover;">
                    
                    
                    <?php if($product->stok > 0): ?>
                        <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Tersedia
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">
                            <i class="fas fa-times-circle me-1"></i>Stok Habis
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="product-details">
                
                <h1 class="display-6 fw-bold text-dark mb-3"><?php echo e($product->nama_produk); ?></h1>
                
                
                <div class="price-section mb-4">
                    <h2 class="text-primary fw-bold mb-2" style="font-size: 2.5rem;">
                        Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                    </h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-truck me-2"></i>Gratis ongkir untuk pembelian di atas Rp 100.000
                    </p>
                </div>

                
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="info-card bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-box text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="fw-semibold mb-1">Stok Tersedia</h6>
                            <p class="text-muted mb-0"><?php echo e($product->stok); ?> unit</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-card bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-shield-alt text-success mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="fw-semibold mb-1">Garansi</h6>
                            <p class="text-muted mb-0">30 hari</p>
                        </div>
                    </div>
                </div>

                
                <div class="description-section mb-4">
                    <h5 class="fw-semibold mb-3">Deskripsi Produk</h5>
                    <div class="bg-light rounded-3 p-3">
                        <p class="text-muted mb-0">
                            Produk berkualitas tinggi dengan standar terbaik. Cocok untuk kebutuhan sehari-hari 
                            dengan desain yang modern dan fungsional.
                        </p>
                    </div>
                </div>

                
                <div class="quantity-section mb-4">
                    <h6 class="fw-semibold mb-3">Jumlah Pembelian</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="quantity-controls bg-light rounded-3 p-2 d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary rounded-circle" 
                                    type="button" id="minusBtn" style="width: 40px; height: 40px;">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantityInput" 
                                   class="form-control text-center border-0 bg-transparent fw-semibold mx-2" 
                                   value="1" min="1" max="<?php echo e($product->stok); ?>" 
                                   style="width: 80px; font-size: 1.1rem;">
                            <button class="btn btn-sm btn-outline-secondary rounded-circle" 
                                    type="button" id="plusBtn" style="width: 40px; height: 40px;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <span class="text-muted">Tersedia <?php echo e($product->stok); ?> unit</span>
                    </div>
                </div>

                
                <div class="action-buttons">
                    <div class="d-grid gap-3">
                        <button class="btn btn-primary btn-lg rounded-3 py-3 add-to-cart fw-semibold"
                                data-id="<?php echo e($product->id); ?>"
                                data-name="<?php echo e($product->nama_produk); ?>"
                                data-price="<?php echo e($product->harga); ?>"
                                data-stok="<?php echo e($product->stok); ?>"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Tambah ke Keranjang
                        </button>
                        
                        <a href="<?php echo e(url('/keranjang')); ?>" 
                           class="btn btn-outline-primary btn-lg rounded-3 py-3 fw-semibold">
                            <i class="fas fa-bolt me-2"></i>
                            Beli Sekarang
                        </a>
                    </div>
                </div>

                
                <div class="additional-info mt-4 pt-4 border-top">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-heart me-2 text-danger"></i>
                                <span>Disukai oleh 1.2k+ pembeli</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-star me-2 text-warning"></i>
                                <span>Rating 4.8/5 (150 ulasan)</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-clock me-2 text-info"></i>
                                <span>Estimasi pengiriman 1-3 hari kerja</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .product-main-image {
        transition: transform 0.3s ease;
    }
    
    .product-main-image:hover {
        transform: scale(1.05);
    }
    
    .info-card {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .info-card:hover {
        border-color: #dee2e6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .quantity-controls {
        border: 2px solid #e9ecef;
        transition: border-color 0.3s ease;
    }
    
    .quantity-controls:focus-within {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-outline-primary {
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
    }
    
    .hover-text-primary:hover {
        color: #667eea !important;
    }
    
    .badge {
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .description-section {
        border-left: 4px solid #667eea;
        padding-left: 1rem;
    }
    
    .product-image-container {
        position: sticky;
        top: 2rem;
    }
    
    @media (max-width: 768px) {
        .product-image-container {
            position: static;
        }
        
        .display-6 {
            font-size: 1.75rem;
        }
        
        .price-section h2 {
            font-size: 2rem !important;
        }
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const qtyInput = document.getElementById('quantityInput');
        const minusBtn = document.getElementById('minusBtn');
        const plusBtn = document.getElementById('plusBtn');
        const maxStok = parseInt("<?php echo e($product->stok); ?>");

        // Quantity controls
        minusBtn.addEventListener('click', () => {
            if (qtyInput.value > 1) {
                qtyInput.value--;
                updateButtonStates();
            }
        });

        plusBtn.addEventListener('click', () => {
            if (parseInt(qtyInput.value) < maxStok) {
                qtyInput.value++;
                updateButtonStates();
            }
        });

        // Update button states
        function updateButtonStates() {
            const currentQty = parseInt(qtyInput.value);
            minusBtn.disabled = currentQty <= 1;
            plusBtn.disabled = currentQty >= maxStok;
        }

        // Input validation
        qtyInput.addEventListener('input', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxStok) {
                this.value = maxStok;
            }
            updateButtonStates();
        });

        // Add to cart with enhanced feedback
        document.querySelector('.add-to-cart').addEventListener('click', function () {
            const quantity = parseInt(qtyInput.value);
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseInt(this.dataset.price);
            const stok = parseInt(this.dataset.stok);

            // Button loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...';
            this.disabled = true;

            setTimeout(() => {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let item = cart.find(item => item.id === id);

                if (item) {
                    if (item.quantity + quantity > stok) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stok Tidak Cukup',
                            text: 'Jumlah melebihi stok yang tersedia.',
                            confirmButtonColor: '#667eea'
                        });
                        this.innerHTML = originalText;
                        this.disabled = false;
                        return;
                    }
                    item.quantity += quantity;
                } else {
                    cart.push({ id, name, price, stok, quantity });
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                // Success animation
                this.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil Ditambahkan!';
                this.style.background = '#28a745';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.background = '';
                    this.disabled = false;
                }, 1500);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: `${name} (${quantity} unit) berhasil ditambahkan ke keranjang.`,
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#fff',
                    color: '#333'
                });
            }, 500);
        });

        // Initialize button states
        updateButtonStates();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/product/detail.blade.php ENDPATH**/ ?>