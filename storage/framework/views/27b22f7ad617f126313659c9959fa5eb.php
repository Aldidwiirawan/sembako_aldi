

<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Modern Minimalist Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-decoration-none" href="<?php echo e(url('order')); ?>">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                    <span class="fw-bold text-dark fs-4">MADURA MART</span>
                </div>
            </a>

            <form action="<?php echo e(route('search')); ?>" method="GET" class="d-flex flex-grow-1 mx-5">
                <div class="input-group">
                    <input type="text" name="q" class="form-control border-0 bg-light rounded-pill ps-4"
                        placeholder="Cari produk kebutuhan sehari-hari..." style="height: 48px;">
                    <button class="btn btn-primary rounded-pill ms-2 px-4" type="submit" style="height: 48px;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="d-flex align-items-center gap-3">
                <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle border-0 rounded-pill d-flex align-items-center px-3"
                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <img src="<?php echo e(asset(Auth::user()->foto ?? 'images/default_profile.png')); ?>" alt="Profile"
                                class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            <span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?></span>
                        </button>
                        <ul class="dropdown-menu shadow-lg border-0 rounded-3 mt-2">
                            <li><a class="dropdown-item py-2" href="profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary rounded-pill px-4">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary rounded-pill px-4">Register</a>
                        <a href="<?php echo e(route('product.detail', $product->id)); ?>" class="text-decoration-none text-dark">
                            <div class="card shadow-sm">
                                <img src="<?php echo e(asset($product->foto)); ?>" class="card-img-top">
                                <div class="card-body">
                                    <h5><?php echo e($product->nama_produk); ?></h5>
                                    <p class="text-primary">Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?></p>
                                </div>
                            </div>
                        </a>

                    </div>
                <?php endif; ?>

                <div class="position-relative">
                    <a href="keranjang"
                        class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 48px; height: 48px;">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </a>
                    <span id="cart-count"
                        class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 20px; height: 20px; font-size: 12px;">0</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Navigation -->
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-center flex-wrap gap-2 py-3">
                    <a href="#bahan_pokok" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                        <i class="fas fa-grain me-2"></i>Bahan Pokok
                    </a>
                    <a href="#snack" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                        <i class="fas fa-cookie-bite me-2"></i>Snack
                    </a>
                    <a href="#minuman" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                        <i class="fas fa-cup me-2"></i>Minuman
                    </a>
                    <a href="#obat" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                        <i class="fas fa-pills me-2"></i>Obat
                    </a>
                    <a href="#alat_mandi" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none">
                        <i class="fas fa-soap me-2"></i>Alat Mandi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="1"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/user_3.jpeg" class="d-block w-100 modern-carousel-img" alt="Promo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/aldiCEO.jpg" class="d-block w-100 modern-carousel-img" alt="Promo 2">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark mb-2">Produk Pilihan Kami</h2>
            <p class="text-muted">Kebutuhan sehari-hari dengan kualitas terbaik</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">

                
                <?php
                    $categories = [
                        1 => ['id' => 'bahan_pokok', 'title' => 'Bahan Pokok', 'icon' => 'fa-grain'],
                        3 => ['id' => 'snack', 'title' => 'Snack', 'icon' => 'fa-cookie-bite'],
                        5 => ['id' => 'minuman', 'title' => 'Minuman', 'icon' => 'fa-cup'],
                        6 => ['id' => 'obat', 'title' => 'Obat', 'icon' => 'fa-pills'],
                        7 => ['id' => 'alat_mandi', 'title' => 'Alat Mandi', 'icon' => 'fa-soap'],
                    ];
                ?>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori_id => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($dataproduk->where('kategori_id', $kategori_id)->isNotEmpty()): ?>
                        <div id="<?php echo e($category['id']); ?>" class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="fas <?php echo e($category['icon']); ?> text-white"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0"><?php echo e($category['title']); ?></h3>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                                <?php $__currentLoopData = $dataproduk->where('kategori_id', $kategori_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col">
                                        <a href="<?php echo e(route('produk.detail', $data->id)); ?>" class="text-decoration-none">
                                            <?php if (isset($component)) { $__componentOriginalecfc721726b8b5798826c96d529d8b59 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecfc721726b8b5798826c96d529d8b59 = $attributes; } ?>
<?php $component = App\View\Components\ProductCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ProductCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecfc721726b8b5798826c96d529d8b59)): ?>
<?php $attributes = $__attributesOriginalecfc721726b8b5798826c96d529d8b59; ?>
<?php unset($__attributesOriginalecfc721726b8b5798826c96d529d8b59); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecfc721726b8b5798826c96d529d8b59)): ?>
<?php $component = $__componentOriginalecfc721726b8b5798826c96d529d8b59; ?>
<?php unset($__componentOriginalecfc721726b8b5798826c96d529d8b59); ?>
<?php endif; ?>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>

    <!-- Modern Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">
                            <i class="fas fa-shopping-bag text-white"></i>
                        </div>
                        <h5 class="fw-bold text-primary mb-0">Madura Mart</h5>
                    </div>
                    <p class="text-light">
                        Sebagai pusat sembako online terpercaya, kami menghadirkan kebutuhan sehari-hari
                        dengan kualitas terbaik dan harga terjangkau.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-light hover-text-primary">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://youtube.com/shorts/bS6m7fex4bI?si=BLz8IW5XafSXVfos" class="text-light hover-text-primary">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-light hover-text-primary">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold text-primary mb-3">Layanan Pelanggan</h6>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span class="text-light">customer@maduramart.com</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fab fa-whatsapp text-primary me-2"></i>
                        <span class="text-light">+62 823 3131 8598</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <span class="text-light">24/7 Customer Support</span>
                    </div>
                </div>

                <div class="col-md-4 mb-4 text-center">
                    <h6 class="fw-bold text-primary mb-3">Founder</h6>
                    <div class="d-flex flex-column align-items-center">
                        <img src="<?php echo e(asset('images/aldiCEO.jpg')); ?>" alt="Founder" class="rounded-circle mb-2"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        <p class="text-light mb-0">Aldi Dwi Irawawan</p>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">© 2024 Madura Mart. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-light text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
        }

        .modern-carousel-img {
            height: 300px;
            object-fit: cover;
            border-radius: 1rem;
        }

        .product-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-primary {
            border: 2px solid #667eea;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .navbar {
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e7eb;
        }

        .hover-text-primary:hover {
            color: #667eea !important;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-indicators button {
            background: #667eea;
            border-radius: 50%;
            width: 12px;
            height: 12px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            function updateCartCount() {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                document.getElementById('cart-count').innerText = totalItems;
            }

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
            }

            // Inisialisasi saat halaman dimuat
            updateCartCount();

            // Event Listener untuk tombol "Add to Cart"
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const productName = this.dataset.name;
                    const productPrice = parseInt(this.dataset.price);
                    const productStok = parseInt(this.dataset.stok);

                    let existingProduct = cart.find(item => item.id === productId);

                    // ✨ PENINGKATAN: Cek stok sebelum menambahkan
                    if (existingProduct && existingProduct.quantity >= productStok) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Stok Tidak Cukup',
                            text: `Anda tidak bisa menambahkan lebih dari ${productStok} item untuk produk ini.`,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return; // Hentikan fungsi
                    }

                    if (existingProduct) {
                        existingProduct.quantity++;
                    } else {
                        cart.push({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            stok: productStok,
                            quantity: 1
                        });
                    }

                    saveCart();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `${productName} telah ditambahkan ke keranjang.`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        background: '#f8f9fa',
                        color: '#495057'
                    });
                });
            });

            // Smooth scrolling untuk link kategori
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetElement = document.querySelector(this.getAttribute('href'));
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/order.blade.php ENDPATH**/ ?>