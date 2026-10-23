

<?php $__env->startSection('title', 'Keranjang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1 class="fw-bold">Keranjang Belanja</h1>
        <br>
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Diisi oleh JavaScript -->
            </tbody>
        </table>

        <div class="text-end mt-4">
            <p>Ongkir: <strong>Rp <span id="shipping-cost">16.000</span></strong></p>
            <p>Harga: <strong>Rp <span id="total-price">0</span></strong></p>
            <h4>Total: <strong>Rp <span id="grand-total">0</span></strong></h4>

            <button class="btn btn-primary" id="checkout-btn">Bayar</button>
            <a href="/order" class="btn btn-secondary">Batal</a>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>">
    </script>
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let shippingCost = 16000;

        function renderCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';

            let totalPrice = 0;

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Keranjang kosong</td>
                </tr>
            `;
            } else {
                let adaProduk = false;
                cart.forEach((item, index) => {
                    // Tampilkan baris meskipun harga/jumlah 0, selama ada nama produk
                    if (item.name) {
                        adaProduk = true;
                        const price = item.price ? item.price : 0;
                        const quantity = item.quantity ? item.quantity : 0;
                        const subtotal = price * quantity;
                        totalPrice += subtotal;

                        cartItemsContainer.innerHTML += `
                        <tr>
                            <td>${item.name}</td>
                            <td class="text-end">Rp ${price.toLocaleString()}</td>
                            <td>
                                <div class="input-group" style="max-width: 150px;">
                                    <button class="btn btn-sm btn-warning" onclick="decreaseQuantity(${index})">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" value="${quantity}" min="1" max="${item.stok || 99}" onchange="changeQuantity(${index}, this.value)">
                                    <button class="btn btn-sm btn-success" onclick="increaseQuantity(${index})">+</button>
                                </div>
                            </td>
                            <td class="text-end">Rp ${subtotal.toLocaleString()}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                            </td>
                        </tr>
                    `;
                    }
                });
                if (!adaProduk) {
                    cartItemsContainer.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">Data produk di keranjang tidak lengkap</td>
                    </tr>
                `;
                }
            }

            const grandTotal = totalPrice + shippingCost;

            document.getElementById('total-price').textContent = totalPrice.toLocaleString();
            document.getElementById('shipping-cost').textContent = shippingCost.toLocaleString();
            document.getElementById('grand-total').textContent = grandTotal.toLocaleString();
        }

        function increaseQuantity(index) {
            if (cart[index].quantity < cart[index].stok) {
                cart[index].quantity++;
                saveCart();
            } else {
                alert('Stok tidak mencukupi!');
            }
        }

        function decreaseQuantity(index) {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            } else {
                cart.splice(index, 1);
            }
            saveCart();
        }

        function changeQuantity(index, value) {
            let quantity = parseInt(value);
            if (isNaN(quantity) || quantity < 1) quantity = 1;
            if (quantity > cart[index].stok) {
                alert("Jumlah melebihi stok tersedia!");
                quantity = cart[index].stok;
            }
            cart[index].quantity = quantity;
            saveCart();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            saveCart();
        }

        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }

        document.getElementById('checkout-btn').addEventListener('click', function() {
            if (cart.length === 0) {
                alert("Keranjang kosong.");
                return;
            }

            const items = cart.map(item => ({
                id: item.id,
                price: item.price,
                quantity: item.quantity,
                name: item.name
            }));

            fetch("<?php echo e(route('midtrans.token')); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        items
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            alert('Pembayaran berhasil!');
                            localStorage.removeItem('cart');
                            fetch("<?php echo e(route('update.status2')); ?>", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
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
                            alert('Menunggu pembayaran!');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                        }
                    });
                });
        });

        renderCart();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\acer\Videos\sembako_aldi\resources\views/keranjang.blade.php ENDPATH**/ ?>