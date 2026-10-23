@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h4>Tambah Data Stok Keluar</h4>

    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✅ Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- NOTIFIKASI ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Terjadi Kesalahan:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('stok-keluar.store') }}" id="stokForm">
        @csrf

        <div class="mb-3">
            <label for="created_at" class="form-label">Tanggal:</label>
            <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan" value="{{ old('keterangan') }}">
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
                        <th>Jumlah Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="produkBody">
                    <tr>
                        <td class="position-relative">
                            <input type="text" name="nama_produk[]" class="form-control nama-produk" autocomplete="off" value="{{ old('nama_produk.0') }}">
                            <input type="hidden" name="produk_id[]" class="produk-id" value="{{ old('produk_id.0') }}">
                            <div class="produk-list" style="display:none; position:absolute; z-index:1000; background:white; border:1px solid #ccc; width:100%; max-height:200px; overflow-y:auto;"></div>
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control qty-input" min="1" value="{{ old('qty.0', 1) }}">
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
                <i class="fas fa-save me-2"></i>💾 Simpan Stok Keluar
            </button>
            <a href="{{ route('stok-keluar') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>← Kembali ke Daftar
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Script Stok Keluar loaded!');
    
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
            <td>
                <input type="number" name="qty[]" class="form-control qty-input" min="1" value="1">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-btn">🗑️</button>
            </td>
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
                fetch(`{{ route('produk.search') }}?query=${encodeURIComponent(query)}`)
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
            const qtyInput = row.querySelector('.qty-input');
            const list = row.querySelector('.produk-list');
            
            input.value = item.textContent.trim();
            hidden.value = item.dataset.id;
            
            list.style.display = 'none';
            qtyInput.focus();
            
            // Validasi form setelah memilih produk
            validateForm();
        }
    });

    // 5. VALIDASI FORM REAL-TIME
    function validateForm() {
        const rows = document.querySelectorAll('#produkBody tr');
        let isValid = true;
        let errorMessage = '';
        
        rows.forEach(row => {
            const produkId = row.querySelector('.produk-id').value;
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            
            if (!produkId) {
                isValid = false;
                errorMessage = 'Semua produk harus dipilih';
            } else if (qty < 1) {
                isValid = false;
                errorMessage = 'Jumlah harus minimal 1';
            }
        });
        
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = !isValid;
            if (!isValid) {
                submitBtn.title = errorMessage;
            } else {
                submitBtn.title = 'Klik untuk menyimpan stok keluar';
            }
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

    // 7. CONFIRMATION BEFORE SUBMIT
    document.getElementById('stokForm').addEventListener('submit', function(e) {
        const rows = document.querySelectorAll('#produkBody tr');
        let totalItems = 0;
        let produkList = [];
        
        rows.forEach(row => {
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            const namaProduk = row.querySelector('.nama-produk').value;
            totalItems += qty;
            produkList.push(`${namaProduk} (${qty} pcs)`);
        });
        
        const confirmationMessage = `Anda akan mengeluarkan ${totalItems} item stok:\n${produkList.join('\n')}\n\nLanjutkan?`;
        
        if (!confirm(confirmationMessage)) {
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

    // Event listeners untuk validasi real-time
    document.getElementById('produkBody').addEventListener('input', function(e) {
        if (e.target.classList.contains('nama-produk') || e.target.classList.contains('qty-input')) {
            validateForm();
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

.btn-success:hover:not(:disabled) {
    background: linear-gradient(135deg, #218838, #1e9e8a);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-success:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
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

.table td {
    vertical-align: middle;
}
</style>
@endsection