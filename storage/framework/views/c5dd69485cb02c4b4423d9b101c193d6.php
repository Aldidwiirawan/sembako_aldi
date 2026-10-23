<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="card product-card border-0 shadow-sm h-100 rounded-4 overflow-hidden position-relative transition-all">
    <!-- Link ke detail produk -->
    <a href="<?php echo e(route('produk.detail', $product->id)); ?>" class="text-decoration-none text-dark d-block">
        <!-- Gambar Produk -->
        <div class="position-relative">
            <img src="<?php echo e(asset($product->foto)); ?>" alt="<?php echo e($product->nama_produk); ?>"
                class="w-100" style="height: 200px; object-fit: cover;">

            <!-- Badge Stok -->
            <div class="position-absolute top-0 end-0 m-2">
                <span class="badge bg-white text-dark shadow-sm rounded-pill px-3 py-1">
                    Stok: <?php echo e($product->stok); ?>

                </span>
            </div>
        </div>

        <!-- Konten Produk -->
        <div class="card-body d-flex flex-column p-3">
            <h6 class="fw-semibold text-truncate mb-1"><?php echo e($product->nama_produk); ?></h6>
            <p class="text-primary fw-bold mb-0 fs-6">
                Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

            </p>
        </div>
    </a>

    <!-- Tombol Keranjang -->
    <?php if($product->stok > 0): ?>
        <button
            class="btn btn-primary btn-sm rounded-circle position-absolute end-0 bottom-0 m-3 add-to-cart shadow-sm"
            style="width: 38px; height: 38px;"
            data-id="<?php echo e($product->id); ?>"
            data-stok="<?php echo e($product->stok); ?>"
            data-name="<?php echo e($product->nama_produk); ?>"
            data-price="<?php echo e($product->harga_jual); ?>"
            title="Tambah ke Keranjang"
        >
            <i class="fas fa-cart-plus"></i>
        </button>
    <?php else: ?>
        <span class="badge bg-secondary position-absolute end-0 bottom-0 m-3 p-2 rounded-pill">
            Stok Habis
        </span>
    <?php endif; ?>
</div>

<style>
    .product-card {
        transition: all 0.3s ease;
        background-color: #fff;
        border-radius: 1rem;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .add-to-cart:hover {
        transform: scale(1.1);
        transition: 0.2s ease-in-out;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<?php /**PATH D:\PKL\toko aldi\New\sembako_aldi\resources\views/components/product-card.blade.php ENDPATH**/ ?>