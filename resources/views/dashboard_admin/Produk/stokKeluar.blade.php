@extends('layouts.master')

@section('title', 'Stok Keluar - Dashboard Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-success mb-1">
                        <i class="bi bi-box-arrow-up me-2"></i>Stok Keluar
                    </h2>
                    <p class="text-muted mb-0">Kelola dan pantau stok keluar dari inventory</p>
                </div>
                <div class="d-flex gap-2">
                    {{-- Tombol Export PDF --}}
                    <a href="{{ route('stok-keluar.export-pdf') }}" class="btn btn-outline-danger" id="exportPdf" target="_blank">
                        <i class="bi bi-file-pdf me-2"></i>Export PDF
                    </a>
                    {{-- Tombol Tambah Data --}}
                    <a href="{{ route('stok-keluar.form') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Stok Keluar
                    </a>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Transaksi</h6>
                                    <h3 class="mb-0 text-primary">{{ $historiStokKeluar->where('tipe', 'Stok Keluar')->count() }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-receipt text-primary fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Item Keluar</h6>
                                    <h3 class="mb-0 text-success">
                                        {{ $historiStokKeluar->where('tipe', 'Stok Keluar')->sum(function($histori) {
                                            return $histori->detailStokKeluar->sum('qty');
                                        }) }}
                                    </h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-box-seam text-success fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table me-2"></i>Daftar Stok Keluar
                        </h5>
                        <span class="badge bg-light text-dark fs-6">
                            {{ $historiStokKeluar->where('tipe', 'Stok Keluar')->count() }} Data
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tabel-stok-keluar">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%" class="ps-4">No.</th>
                                    <th width="12%">ID Histori</th>
                                    <th width="35%">Keterangan</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="18%">Total Item</th>
                                    <th width="10%" class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stokKeluarData = $historiStokKeluar->where('tipe', 'Stok Keluar');
                                @endphp
                                @forelse ($stokKeluarData as $histori)
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-dark fs-6">#{{ $histori->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-box-arrow-up me-2 text-danger"></i>
                                            <span class="text-truncate" style="max-width: 200px;">
                                                {{ $histori->keterangan }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $histori->created_at->format('d M Y') }}</span>
                                            <small class="text-muted">{{ $histori->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger text-white fs-6 px-3 py-2">
                                            {{ $histori->detailStokKeluar->sum('qty') }} item
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <button class="btn btn-primary btn-sm px-3 py-2" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal-{{ $histori->id }}"
                                                title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                            <h5 class="mb-3">Tidak ada data stok keluar</h5>
                                            <a href="{{ route('stok-keluar.form') }}" class="btn btn-success btn-lg">
                                                <i class="bi bi-plus-circle me-2"></i>Tambah Stok Keluar Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail Modals --}}
@foreach ($historiStokKeluar->where('tipe', 'Stok Keluar') as $histori)
<div class="modal fade" id="detailModal-{{ $histori->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $histori->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="detailModalLabel-{{ $histori->id }}">
                    <i class="bi bi-list-ul me-2"></i>Detail Stok Keluar #{{ $histori->id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Header Info --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-success mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Transaksi
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>ID Transaksi</strong></td>
                                        <td>: #{{ $histori->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal</strong></td>
                                        <td>: {{ $histori->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan</strong></td>
                                        <td>: {{ $histori->keterangan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-success mb-3">
                                    <i class="bi bi-graph-up me-2"></i>Ringkasan
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>Total Item</strong></td>
                                        <td>: {{ $histori->detailStokKeluar->sum('qty') }} item</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Produk</strong></td>
                                        <td>: {{ $histori->detailStokKeluar->count() }} produk</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detail Items --}}
                <h6 class="text-success mb-3">
                    <i class="bi bi-box-seam me-2"></i>Detail Barang
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="65%">Nama Produk</th>
                                <th width="30%" class="text-center">Jumlah Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histori->detailStokKeluar as $index => $stok)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($stok->produk->foto)
                                            <img src="{{ asset($stok->produk->foto) }}" 
                                                 alt="{{ $stok->produk->nama_produk }}" 
                                                 class="rounded me-3" 
                                                 width="45" height="45" 
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 45px; height: 45px;">
                                                <i class="bi bi-image text-white fs-5"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-semibold">{{ $stok->produk->nama_produk }}</div>
                                            <small class="text-muted">Kode: {{ $stok->produk->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger fs-6 px-3">-{{ $stok->qty }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td colspan="2" class="text-end fw-bold">TOTAL ITEM KELUAR:</td>
                                <td class="text-center fw-bold text-danger fs-5">
                                    {{ $histori->detailStokKeluar->sum('qty') }} item
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('styles')
<style>
    .card {
        border-radius: 12px;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.95rem;
        padding: 1rem 0.75rem;
        border-bottom: 2px solid #198754;
    }
    
    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .btn-sm {
        border-radius: 8px;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(25, 135, 84, 0.05);
    }
    
    .modal-header {
        border-radius: 0;
        border-bottom: 2px solid #198754;
    }
    
    /* Style untuk tombol Export PDF */
    .btn-outline-danger {
        border: 2px solid #dc3545;
        color: #dc3545;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with better configuration
        $('#tabel-stok-keluar').DataTable({
            searching: true,
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            language: {
                search: "Cari:",
                paginate: {
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                lengthMenu: "Tampilkan _MENU_ data",
                emptyTable: "Tidak ada data stok keluar",
                zeroRecords: "Data tidak ditemukan"
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            initComplete: function() {
                // Style the search input
                $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Cari ID atau keterangan...');
                $('.dataTables_length select').addClass('form-select');
            }
        });

        // Export PDF functionality
        $('#exportPdf').on('click', function(e) {
            e.preventDefault();
            
            // Tampilkan konfirmasi
            if (confirm('Export data Stok Keluar ke PDF?')) {
                // Tampilkan loading
                const originalText = $(this).html();
                $(this).html('<i class="bi bi-hourglass-split me-2"></i>Loading...').prop('disabled', true);
                
                // Redirect ke route export PDF
                window.location.href = "{{ route('stok-keluar.export-pdf') }}";
                
                // Reset tombol setelah 2 detik
                setTimeout(() => {
                    $(this).html(originalText).prop('disabled', false);
                }, 2000);
            }
        });
    });
</script>
@endpush