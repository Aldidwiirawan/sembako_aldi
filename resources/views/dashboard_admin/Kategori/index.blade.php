@extends('layouts.master')

@section('content')

<style>
    /* Custom styles for kategori page */
    .card-shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
    }
    
    .btn-action {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(40, 167, 69, 0.05);
    }
    
    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    .search-box {
        max-width: 300px;
    }
    
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .kategori-icon {
        width: 40px;
        height: 40px;
        background: rgba(40, 167, 69, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
</style>

<!-- Main Content -->
<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-success mb-1">
                <i class="bi bi-tags me-2"></i>Data Kategori
            </h2>
            <p class="text-muted mb-0">Kelola data kategori produk inventory</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-2">Total Kategori</h6>
                            <h3 class="fw-bold text-success">{{ $datakategori->count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-tags text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="card-title mb-0">
                <i class="bi bi-list-ul me-2"></i>Daftar Kategori
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari kategori...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tabel-kategori">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 8%">No.</th>
                            <th style="width: 20%">Kode Kategori</th>
                            <th style="width: 40%">Nama Kategori</th>
                            <th style="width: 20%">Jumlah Produk</th>
                            <th style="width: 12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datakategori as $data)
                        <tr class="kategori-row">
                            <td class="fw-medium">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success status-badge">
                                    {{ $data->id }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="kategori-icon">
                                        <i class="bi bi-tag text-success"></i>
                                    </div>
                                    <span class="fw-medium">{{ $data->nama_kategori }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">
                                    {{ $data->produk_count ?? 0 }} Produk
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-warning btn-action" 
                                       data-bs-toggle="tooltip" title="Edit Kategori">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-action" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}"
                                            data-bs-tooltip="tooltip" title="Hapus Kategori">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">
                                            <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                                        <div class="alert alert-warning">
                                            <strong>Kategori:</strong> {{ $data->nama_kategori }}<br>
                                            <strong>Kode:</strong> {{ $data->id }}
                                        </div>
                                        <p class="text-danger small">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Data yang dihapus tidak dapat dikembalikan.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-2"></i>Batal
                                        </button>
                                        <form action="{{ route('kategori.delete', $data->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="bi bi-tags"></i>
                                <h5 class="mt-3">Belum Ada Data Kategori</h5>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama Anda</p>
                                <a href="{{ route('kategori.create') }}" class="btn btn-success mt-2">
                                    <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.kategori-row');
                
                rows.forEach(row => {
                    const kategoriName = row.cells[2].textContent.toLowerCase();
                    const kategoriCode = row.cells[1].textContent.toLowerCase();
                    
                    if (kategoriName.includes(searchTerm) || kategoriCode.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection