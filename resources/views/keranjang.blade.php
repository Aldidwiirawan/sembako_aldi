<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madura Mart - Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --dark-color: #2d3748;
            --light-color: #f8f9fa;
            --border-radius: 1rem;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            padding: 20px 15px;
            scroll-behavior: smooth;
            min-height: 100vh;
        }

        .cart-container {
            max-width: 1100px;
            margin: 1rem auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .cart-header {
            background: var(--primary-gradient);
            color: white;
            padding: 1.2rem 1.5rem;
        }

        .cart-title {
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.4rem;
        }

        .cart-body {
            padding: 1.5rem;
        }

        .table-cart {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.95rem;
        }

        .table-cart thead th {
            background-color: #f1f5f9;
            padding: 0.9rem 0.8rem;
            font-weight: 600;
            border: none;
            font-size: 0.9rem;
        }

        .table-cart tbody tr {
            transition: all 0.3s ease;
        }

        .table-cart tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
        }

        .table-cart td {
            padding: 1rem 0.8rem;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-name {
            font-weight: 500;
            margin-bottom: 3px;
            font-size: 0.95rem;
        }

        .product-category {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            max-width: 130px;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            background: white;
            transition: var(--transition);
            font-size: 0.8rem;
        }

        .quantity-btn:hover {
            background-color: #f1f5f9;
        }

        .quantity-input {
            width: 45px;
            height: 32px;
            text-align: center;
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            border-radius: 0;
            font-size: 0.9rem;
        }

        .empty-cart {
            text-align: center;
            padding: 2.5rem;
            color: #6b7280;
        }

        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        .cart-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.3rem;
            margin-top: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.95rem;
        }

        .summary-total {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary-color);
            border-bottom: none;
            margin-top: 0.5rem;
        }

        .btn-checkout {
            background: var(--primary-gradient);
            border: none;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: var(--transition);
            width: 100%;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-cancel {
            background-color: white;
            border: 1px solid #6b7280;
            color: #6b7280;
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-cancel:hover {
            background-color: #f1f5f9;
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            font-size: 1.1rem;
            transition: var(--transition);
            padding: 4px;
            border-radius: 4px;
        }

        .remove-btn:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }

        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            border: none;
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .spinner {
            width: 45px;
            height: 45px;
            border: 4px solid rgba(102, 126, 234, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .notification-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 280px;
            max-width: 350px;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px 10px;
            }

            .cart-container {
                margin: 0.5rem auto;
            }

            .cart-body {
                padding: 1rem;
            }

            .cart-header {
                padding: 1rem 1.2rem;
            }

            .cart-title {
                font-size: 1.2rem;
            }

            .table-cart {
                font-size: 0.9rem;
            }

            .table-cart thead {
                display: none;
            }

            .table-cart tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 0.8rem;
            }

            .table-cart td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.7rem 0;
                border-bottom: 1px solid #e5e7eb;
                font-size: 0.9rem;
            }

            .table-cart td:last-child {
                border-bottom: none;
            }

            .table-cart td::before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 0.8rem;
                font-size: 0.85rem;
            }

            .quantity-control {
                max-width: 120px;
            }

            .quantity-btn {
                width: 30px;
                height: 30px;
                font-size: 0.75rem;
            }

            .quantity-input {
                width: 40px;
                height: 30px;
                font-size: 0.85rem;
            }

            .cart-summary {
                padding: 1rem;
                margin-top: 1rem;
            }

            .summary-row {
                font-size: 0.9rem;
            }

            .summary-total {
                font-size: 1rem;
            }

            .btn-checkout,
            .btn-cancel {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px 8px;
            }

            .cart-header {
                padding: 0.8rem 1rem;
            }

            .cart-title {
                font-size: 1.1rem;
            }

            .cart-body {
                padding: 0.8rem;
            }

            .empty-cart {
                padding: 2rem 1rem;
            }

            .empty-cart i {
                font-size: 2.5rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease forwards;
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <div class="notification-toast" id="notificationToast"></div>

    <div class="container animate-fadeIn">
        <div class="cart-container">
            <div class="cart-header">
                <h1 class="cart-title">
                    <i class="fas fa-shopping-cart"></i> Keranjang Belanja
                </h1>
            </div>

            <div class="cart-body">
                <div class="table-responsive">
                    <table class="table-cart">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-end">Harga</th>
                                <th>Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Subtotal Produk:</span>
                        <span>Rp <span id="total-price">0</span></span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pengiriman:</span>
                        <span>Rp <span id="shipping-cost">16.000</span></span>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total Pembayaran:</span>
                        <span>Rp <span id="grand-total">0</span></span>
                    </div>

                    <button class="btn btn-checkout" id="checkout-btn">
                        <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                    </button>
                    <a href="{{ url('order') }}" class="btn btn-cancel">
                        <i class="fas fa-arrow-left me-2"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>

    <button class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let shippingCost = 16000;

            const loadingOverlay = document.getElementById('loadingOverlay');
            const backToTop = document.getElementById('backToTop');
            const notificationToast = document.getElementById('notificationToast');

            function showNotification(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `alert alert-${type} alert-dismissible fade show`;
                toast.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                notificationToast.appendChild(toast);

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 5000);
            }

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
            });

            function showLoading() {
                loadingOverlay.classList.add('active');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('active');
            }

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function renderCart() {
                const cartItemsContainer = document.getElementById('cart-items');
                cartItemsContainer.innerHTML = '';

                let totalPrice = 0;

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = `
                        <tr>
                            <td colspan="5" class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <h4>Keranjang Belanja Kosong</h4>
                                <p>Silakan tambahkan produk ke keranjang Anda</p>
                                <a href="{{ url('order') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                                </a>
                            </td>
                        </tr>
                    `;
                } else {
                    let adaProduk = false;
                    cart.forEach((item, index) => {
                        if (item.name) {
                            adaProduk = true;
                            const price = item.price ? item.price : 0;
                            const quantity = item.quantity ? item.quantity : 0;
                            const subtotal = price * quantity;
                            totalPrice += subtotal;

                            cartItemsContainer.innerHTML += `
                                <tr>
                                    <td data-label="Produk">
                                        <div>
                                            <div class="product-name">${item.name}</div>
                                            <div class="product-category">Produk</div>
                                        </div>
                                    </td>
                                    <td data-label="Harga" class="text-end">Rp ${price.toLocaleString()}</td>
                                    <td data-label="Jumlah">
                                        <div class="quantity-control">
                                            <button class="quantity-btn" onclick="decreaseQuantity(${index})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="quantity-input" value="${quantity}" min="1" max="${item.stok || 99}" onchange="changeQuantity(${index}, this.value)">
                                            <button class="quantity-btn" onclick="increaseQuantity(${index})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td data-label="Subtotal" class="text-end">Rp ${subtotal.toLocaleString()}</td>
                                    <td data-label="Aksi">
                                        <button class="remove-btn" onclick="removeItem(${index})" title="Hapus dari keranjang">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }
                    });

                    if (!adaProduk) {
                        cartItemsContainer.innerHTML = `
                            <tr>
                                <td colspan="5" class="empty-cart">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <h4>Data Produk Tidak Lengkap</h4>
                                    <p>Beberapa produk di keranjang tidak memiliki informasi yang lengkap</p>
                                </td>
                            </tr>
                        `;
                    }
                }

                const grandTotal = totalPrice + shippingCost;

                document.getElementById('total-price').textContent = totalPrice.toLocaleString();
                document.getElementById('grand-total').textContent = grandTotal.toLocaleString();
            }

            function increaseQuantity(index) {
                if (cart[index].quantity < cart[index].stok) {
                    cart[index].quantity++;
                    saveCart();
                    renderCart();
                } else {
                    showNotification('Stok tidak mencukupi!', 'warning');
                }
            }

            function decreaseQuantity(index) {
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                } else {
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
                        cart.splice(index, 1);
                    }
                }
                saveCart();
                renderCart();
            }

            function changeQuantity(index, value) {
                let quantity = parseInt(value);
                if (isNaN(quantity) || quantity < 1) quantity = 1;
                if (quantity > cart[index].stok) {
                    showNotification("Jumlah melebihi stok tersedia!", 'warning');
                    quantity = cart[index].stok;
                }
                cart[index].quantity = quantity;
                saveCart();
                renderCart();
            }

            function removeItem(index) {
                if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
                    cart.splice(index, 1);
                    saveCart();
                    renderCart();
                    showNotification('Produk dihapus dari keranjang', 'info');
                }
            }

            document.getElementById('checkout-btn').addEventListener('click', function() {
                if (cart.length === 0) {
                    showNotification("Keranjang kosong.", 'warning');
                    return;
                }

                const items = cart.map(item => ({
                    id: item.id,
                    price: item.price,
                    quantity: item.quantity,
                    name: item.name
                }));

                showLoading();

                fetch("{{ route('midtrans.token') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            items
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.error) {
                            showNotification(data.error, 'error');
                            return;
                        }
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                showNotification('Pembayaran berhasil!', 'success');
                                localStorage.removeItem('cart');
                                fetch("{{ route('update.status2') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            snap_token: data.snap_token
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        window.location.href = '/order';
                                    })
                                    .catch(error => console.error("Error:", error));
                            },
                            onPending: function(result) {
                                showNotification('Menunggu pembayaran!', 'info');
                            },
                            onError: function(result) {
                                showNotification('Pembayaran gagal!', 'error');
                            }
                        });
                    })
                    .catch(error => {
                        hideLoading();
                        showNotification('Terjadi kesalahan saat memproses pembayaran', 'error');
                    });
            });

            renderCart();

            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Make functions available globally
            window.increaseQuantity = increaseQuantity;
            window.decreaseQuantity = decreaseQuantity;
            window.changeQuantity = changeQuantity;
            window.removeItem = removeItem;
        });
    </script>
</body>

</html>