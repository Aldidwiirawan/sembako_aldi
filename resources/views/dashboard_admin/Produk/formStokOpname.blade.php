@extends('layouts.master')

@section('content')
<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="d-flex align-items-center">
            <i class="bi bi-clipboard-data-fill me-2" style="font-size: 1.5rem; color: #198754;"></i> 
            Tambah Stok Opname
        </h4>
        <a href="{{ route('stok-opname') }}" class="btn btn-outline-secondary">
            ← Kembali ke Daftar
        </a>
    </div>
    <p class="text-muted" style="margin-top: -10px;">
        Tambah data stok opname baru untuk inventory
    </p>
    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>Form Stok Opname</strong>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{ route('stok-opname.store') }}" id="opnameForm">
                @csrf
                
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
        
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="created_at" class="form-label">Tanggal Opname: *</label>
                        <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="keterangan" class="form-label">Keterangan:</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Masukkan Keterangan">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span id="produkCounter" class="text-muted">0 produk dipilih</span>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduk">
                        ➕ Tambah Produk
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" style="min-width: 600px;">
                        <thead class="table-success">
                            <tr>
                                <th>Nama Produk</th>
                                <th>Stok Sistem</th>
                                <th>Stok Fisik</th>
                                <th>Selisih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="produkTerpilihBody">
                            <tr id="placeholderRow">
                                <td colspan="5" class="text-center text-muted">
                                    <div class="my-3">
                                        <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                                        <p class="mt-2 mb-0">Belum ada produk yang dipilih</p>
                                        <small>Klik tombol "Tambah Produk" untuk menambahkan produk</small>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        ✔️ Simpan Stok Opname
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="modalProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="searchProduk" class="form-control" placeholder="Cari nama produk...">
                </div>

                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Nama Produk</th>
                                <th>Stok Sistem</th>
                                <th>Stok Fisik (Default)</th>
                            </tr>
                        </thead>
                        <tbody id="modalProdukBody">
                            @forelse($produkList as $produk)
                            <tr>
                                <td><input type="checkbox" class="produk-checkbox" value="{{ $produk->id }}" data-nama="{{ $produk->nama_produk }}" data-stok="{{ $produk->stok }}"></td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>
                                    <input type="number" class="form-control stok-fisik-modal" value="{{ $produk->stok }}" min="0" disabled>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnTambahProduk">Tambah Produk Terpilih</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalProdukBody = document.getElementById("modalProdukBody");
        const checkAll = document.getElementById("checkAll");
        const searchProduk = document.getElementById("searchProduk");
        const btnTambahProduk = document.getElementById("btnTambahProduk");
        const produkTerpilihBody = document.getElementById("produkTerpilihBody");
        const modalElement = document.getElementById('modalProduk');
        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
        const form = document.getElementById("opnameForm");

        // --- FUNGSI HELPER ---

        /**
         * Memperbarui placeholder "Belum ada produk" dan counter "X produk dipilih"
         */
        function updatePlaceholderAndCounter() {
            const placeholder = document.getElementById("placeholderRow");
            const rows = produkTerpilihBody.querySelectorAll("tr:not(#placeholderRow)");
            const rowCount = rows.length;
            
            // Update counter
            document.getElementById("produkCounter").innerText = `${rowCount} produk dipilih`;
            
            // Tampilkan/sembunyikan placeholder
            if (placeholder) {
                placeholder.style.display = (rowCount > 0) ? 'none' : 'table-row';
            }
        }

        /**
         * Menghitung dan memperbarui kolom Selisih pada baris tertentu
         * @param {HTMLTableRowElement} row - Baris <tr> yang akan dihitung
         */
        function updateSelisih(row) {
            const stokSistemEl = row.querySelector(".stok-sistem");
            const stokFisikEl = row.querySelector(".stok-fisik");
            const selisihEl = row.querySelector(".selisih");

            if (stokSistemEl && stokFisikEl && selisihEl) {
                const stokSistem = parseInt(stokSistemEl.innerText) || 0;
                const stokFisik = parseInt(stokFisikEl.value) || 0;
                const selisih = stokFisik - stokSistem;

                selisihEl.innerText = selisih;
                
                // Ubah warna berdasarkan selisih
                selisihEl.classList.remove('text-danger', 'text-success', 'text-muted');
                if (selisih < 0) {
                    selisihEl.classList.add('text-danger');
                    selisihEl.innerText = selisih; // -5
                } else if (selisih > 0) {
                    selisihEl.classList.add('text-success');
                    selisihEl.innerText = `+${selisih}`; // +5
                } else {
                    selisihEl.classList.add('text-muted');
                    selisihEl.innerText = '0'; // 0
                }
            }
        }

        // --- EVENT LISTENER MODAL ---

        // Event listener untuk checkbox di modal (mengaktifkan/menonaktifkan input stok fisik)
        modalProdukBody.addEventListener("change", function(e) {
            if (e.target.classList.contains("produk-checkbox")) {
                const input = e.target.closest("tr").querySelector(".stok-fisik-modal");
                if (input) {
                    input.disabled = !e.target.checked;
                    if (e.target.checked) {
                        input.focus();
                        input.select();
                    }
                }
            }
        });

        // Event listener untuk Check All
        checkAll.addEventListener("change", function() {
            const checked = this.checked;
            modalProdukBody.querySelectorAll(".produk-checkbox").forEach(cb => {
                // Hanya check/uncheck baris yang terlihat (tidak terfilter)
                if (cb.closest('tr').style.display !== 'none') {
                    cb.checked = checked;
                    const input = cb.closest("tr").querySelector(".stok-fisik-modal");
                    if (input) {
                        input.disabled = !checked;
                    }
                }
            });
        });

        // Event listener untuk Search/Filter Produk di Modal
        searchProduk.addEventListener("input", function() {
            const filter = this.value.toLowerCase();
            const rows = modalProdukBody.querySelectorAll("tr");
            
            rows.forEach(function(row) {
                const namaProduk = row.children[1].textContent.toLowerCase();
                row.style.display = namaProduk.includes(filter) ? "" : "none";
            });
            // Uncheck "Check All" saat memfilter
            checkAll.checked = false;
        });

        // Event listener untuk Tombol "Tambah Produk" di Modal
        btnTambahProduk.addEventListener("click", function() {
            const checkboxes = modalProdukBody.querySelectorAll(".produk-checkbox:checked");

            checkboxes.forEach(cb => {
                const id = cb.value;
                // Cek apakah produk sudah ada di tabel utama
                const sudahAda = produkTerpilihBody.querySelector(`input[name="produk_id[]"][value="${id}"]`);
                
                if (sudahAda) {
                    // Jika sudah ada, lewati
                    console.warn(`Produk ID ${id} sudah ada.`);
                    return; 
                }

                // Ambil data dari atribut data-* atau dari sel
                const nama = cb.dataset.nama;
                const stokSistem = cb.dataset.stok;
                const stokFisikInput = cb.closest("tr").querySelector(".stok-fisik-modal");
                const stokFisik = stokFisikInput.value;

                // Buat baris baru untuk tabel utama
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>
                        ${nama}
                        <input type="hidden" name="produk_id[]" value="${id}">
                    </td>
                    <td class="stok-sistem">${stokSistem}</td>
                    <td>
                        <input type="number" name="stok_fisik[${id}]" class="form-control form-control-sm stok-fisik" value="${stokFisik}" min="0">
                    </td>
                    <td class="selisih fw-bold text-muted">0</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-hapus-produk">Hapus</button>
                    </td>
                `;
                
                // Tambahkan baris ke tabel utama
                produkTerpilihBody.appendChild(tr);
                
                // Hitung selisih awal
                updateSelisih(tr);

                // Tambahkan event listener untuk input stok fisik yang baru ditambahkan
                tr.querySelector(".stok-fisik").addEventListener("input", function() {
                    updateSelisih(tr);
                });

                // Uncheck checkbox di modal setelah ditambahkan
                cb.checked = false;
                stokFisikInput.disabled = true;
            });

            // Tutup modal
            modalInstance.hide();
            
            // Perbarui tampilan tabel utama
            updatePlaceholderAndCounter();
        });

        // --- EVENT LISTENER TABEL UTAMA ---

        // Event listener untuk tombol Hapus (delegasi event)
        produkTerpilihBody.addEventListener("click", function(e) {
            if (e.target.classList.contains("btn-hapus-produk")) {
                e.target.closest("tr").remove();
                // Perbarui tampilan setelah menghapus
                updatePlaceholderAndCounter();
            }
        });
        
        // --- VALIDASI FORM SEBELUM SUBMIT ---
        form.addEventListener("submit", function(e) {
            const rowCount = produkTerpilihBody.querySelectorAll("tr:not(#placeholderRow)").length;
            if (rowCount === 0) {
                e.preventDefault(); // Hentikan submit form
                alert("Harap tambahkan minimal satu produk untuk di-opname.");
            }
        });

        // --- INISIALISASI ---
        // Panggil saat halaman dimuat untuk mengatur state awal
        updatePlaceholderAndCounter();
    });
</script>
@endsection