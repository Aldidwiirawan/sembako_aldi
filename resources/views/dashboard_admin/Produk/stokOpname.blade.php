@extends('layouts.master')

@section('title', 'Stok Opname - Dashboard Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-success mb-1">
                        <i class="bi bi-clipboard-check me-2"></i>Stok Opname
                    </h2>
                    <p class="text-muted mb-0">Kelola dan pantau stok opname inventory</p>
                </div>
                <div class="d-flex gap-2">
                    {{-- Tombol Export PDF --}}
                    <a href="{{ route('stok-opname.export-pdf') }}" class="btn btn-outline-danger" id="exportPdf" target="_blank">
                        <i class="bi bi-file-pdf me-2"></i>Export PDF
                    </a>
                    {{-- Tombol Tambah Data --}}
                    <a href="{{ route('stok-opname.form') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Stok Opname
                    </a>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Opname</h6>
                                    <h3 class="mb-0 text-primary">{{ $historiStokOpname->count() }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-clipboard-data text-primary fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Produk Diopname</h6>
                                    <h3 class="mb-0 text-success">
                                        {{ $historiStokOpname->sum(function($histori) {
                                            return $histori->detailStokOpname->count();
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
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-2">Total Selisih</h6>
                                    <h4 class="mb-0 text-warning">
                                        {{ $historiStokOpname->sum(function($histori) {
                                            return abs($histori->detailStokOpname->sum('selisih'));
                                        }) }}
                                    </h4>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-graph-up-arrow text-warning fs-3"></i>
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
                            <i class="bi bi-table me-2"></i>Daftar Stok Opname
                        </h5>
                        <span class="badge bg-light text-dark fs-6">
                            {{ $historiStokOpname->count() }} Data
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="tabel-stok-opname">
                            <thead class="table-success">
                                <tr>
                                    <th width="5%" class="ps-4">No.</th>
                                    <th width="12%">ID Histori</th>
                                    <th width="35%">Keterangan</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="18%">Jumlah Produk</th>
                                    <th width="10%" class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($historiStokOpname as $histori)
                                <tr class="border-bottom">
                                    <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-dark fs-6">#{{ $histori->id }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clipboard-check me-2 text-info"></i>
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
                                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                                            {{ $histori->detailStokOpname->count() }} produk
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
                                            <i class="bi bi-clipboard-x display-4 d-block mb-3"></i>
                                            <h5 class="mb-3">Tidak ada data stok opname</h5>
                                            <a href="{{ route('stok-opname.form') }}" class="btn btn-success btn-lg">
                                                <i class="bi bi-plus-circle me-2"></i>Tambah Stok Opname Pertama
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
@foreach ($historiStokOpname as $histori)
<div class="modal fade" id="detailModal-{{ $histori->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $histori->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="detailModalLabel-{{ $histori->id }}">
                    <i class="bi bi-list-ul me-2"></i>Detail Stok Opname #{{ $histori->id }}
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
                                    <i class="bi bi-info-circle me-2"></i>Informasi Opname
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>ID Opname</strong></td>
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
                                        <td width="40%"><strong>Jumlah Produk</strong></td>
                                        <td>: {{ $histori->detailStokOpname->count() }} produk</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Selisih</strong></td>
                                        <td class="fw-bold {{ $histori->detailStokOpname->sum('selisih') < 0 ? 'text-danger' : ($histori->detailStokOpname->sum('selisih') > 0 ? 'text-warning' : 'text-success') }}">
                                            : {{ $histori->detailStokOpname->sum('selisih') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            : 
                                            @php
                                                $totalSelisih = $histori->detailStokOpname->sum('selisih');
                                                if($totalSelisih == 0) {
                                                    echo '<span class="badge bg-success">Match</span>';
                                                } elseif($totalSelisih > 0) {
                                                    echo '<span class="badge bg-warning text-dark">Surplus</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger">Deficit</span>';
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detail Items --}}
                <h6 class="text-success mb-3">
                    <i class="bi bi-box-seam me-2"></i>Detail Produk
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th width="5%" class="text-center">#</th>
                                <th width="45%">Nama Produk</th>
                                <th width="15%" class="text-center">Stok Sistem</th>
                                <th width="15%" class="text-center">Stok Fisik</th>
                                <th width="20%" class="text-center">Selisih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histori->detailStokOpname as $index => $stok)
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
                                    <span class="badge bg-primary fs-6 px-3">{{ $stok->stok_sistem }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark fs-6 px-3">{{ $stok->stok_fisik }}</span>
                                </td>
                                <td class="text-center">
                                    @if($stok->selisih == 0)
                                        <span class="badge bg-success fs-6 px-3">{{ $stok->selisih }}</span>
                                    @elseif($stok->selisih > 0)
                                        <span class="badge bg-warning text-dark fs-6 px-3">+{{ $stok->selisih }}</span>
                                    @else
                                        <span class="badge bg-danger fs-6 px-3">{{ $stok->selisih }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td colspan="2" class="text-end fw-bold">TOTAL SELISIH:</td>
                                <td class="text-center fw-bold">{{ $histori->detailStokOpname->sum('stok_sistem') }}</td>
                                <td class="text-center fw-bold">{{ $histori->detailStokOpname->sum('stok_fisik') }}</td>
                                <td class="text-center fw-bold {{ $histori->detailStokOpname->sum('selisih') < 0 ? 'text-danger' : ($histori->detailStokOpname->sum('selisih') > 0 ? 'text-warning' : 'text-success') }} fs-5">
                                    {{ $histori->detailStokOpname->sum('selisih') }}
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
        $('#tabel-stok-opname').DataTable({
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
                emptyTable: "Tidak ada data stok opname",
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
            if (confirm('Export data Stok Opname ke PDF?')) {
                // Tampilkan loading
                const originalText = $(this).html();
                $(this).html('<i class="bi bi-hourglass-split me-2"></i>Loading...').prop('disabled', true);
                
                // Redirect ke route export PDF
                window.location.href = "{{ route('stok-opname.export-pdf') }}";
                
                // Reset tombol setelah 2 detik
                setTimeout(() => {
                    $(this).html(originalText).prop('disabled', false);
                }, 2000);
            }
        });
    });
</script>
@endpush