@extends('layouts.owner')

{{-- Bagian CSS Khusus Halaman Ini --}}
@section('styles')
    <style>
        /* Pastikan layout utama sudah mengatur sidebar,
           style di sini hanya untuk penyesuaian konten */
        .content-wrapper {
            margin-left: 250px; /* Sesuaikan dengan lebar sidebar Anda */
            padding: 2rem;
            width: calc(100% - 250px);
            background-color: #f8f9fa; /* Warna background abu-abu muda agar card menonjol */
            min-height: 100vh;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">

            {{-- HEADING --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark fw-bold">Dashboard Data User</h3>
            </div>

            {{-- BAGIAN TABEL PEMBELI --}}
            <div class="card mb-5">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="fas fa-users me-2"></i> {{-- Icon (Opsional jika pakai FontAwesome) --}}
                    Data Pembeli
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="bg-light text-success">
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th width="10%">ID</th>
                                    <th width="25%">Nama</th>
                                    <th width="25%">Email</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataPembeli as $data)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-secondary">{{ $data->id }}</span></td>
                                        <td class="fw-semibold">{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->alamat ?? '-' }}</td> {{-- Menangani jika alamat kosong --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                            Tidak ada data pembeli ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Jika menggunakan pagination, aktifkan baris di bawah ini --}}
                {{-- <div class="card-footer bg-white">
                    {{ $dataPembeli->links() }}
                </div> --}}
            </div>


            {{-- BAGIAN TABEL ADMIN --}}
            <div class="card">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="fas fa-user-shield me-2"></i>
                    Data Admin
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th width="10%">ID</th>
                                    <th width="30%">Nama</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataAdmin as $data)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-dark">{{ $data->id }}</span></td>
                                        <td class="fw-semibold">{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Tidak ada data admin ditemukan.
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
@endsection