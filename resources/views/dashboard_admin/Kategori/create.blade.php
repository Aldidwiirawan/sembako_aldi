@extends('layouts.master')

@section('title', 'Tambah Kategori - Aplikasi Laravel')

@section('content')

<style>
    .card-shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 10px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    
    .btn-custom {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-success mb-1">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru
            </h1>
            <p class="text-muted mb-0">Tambahkan kategori produk baru ke dalam sistem inventory</p>
        </div>
        <a href="{{ url('tampil-kategori') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Data Kategori
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card card-shadow border-0">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-tags me-2"></i>Form Tambah Kategori
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag text-success"></i>
                                </span>
                                <input type="text" 
                                       name="nama_kategori" 
                                       class="form-control" 
                                       id="nama_kategori" 
                                       placeholder="Masukkan nama kategori"
                                       required
                                       maxlength="100"
                                       value="{{ old('nama_kategori') }}">
                            </div>
                            <div class="form-text text-muted">
                                Masukkan nama kategori yang jelas dan mudah dipahami. Maksimal 100 karakter.
                            </div>
                            @error('nama_kategori')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ url('tampil-kategori') }}" class="btn btn-outline-danger btn-custom">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-secondary btn-custom">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success btn-custom">
                                    <i class="bi bi-check-circle me-2"></i>Simpan Kategori
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card card-shadow border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-lightbulb text-success fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold text-success mb-2">Contoh Nama Kategori yang Baik</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-muted mb-0">
                                        <li><i class="bi bi-check text-success me-2"></i>Elektronik</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Pakaian</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Makanan</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-muted mb-0">
                                        <li><i class="bi bi-check text-success me-2"></i>Perabotan</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Olahraga</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Kesehatan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi client-side sederhana
        const form = document.querySelector('form');
        const namaKategori = document.getElementById('nama_kategori');
        
        // Auto-focus pada field nama kategori
        namaKategori.focus();
        
        form.addEventListener('submit', function(e) {
            const value = namaKategori.value.trim();
            
            if (value === '') {
                e.preventDefault();
                alert('Nama kategori harus diisi!');
                namaKategori.focus();
                return false;
            }
            
            if (value.length > 100) {
                e.preventDefault();
                alert('Nama kategori maksimal 100 karakter!');
                namaKategori.focus();
                return false;
            }
        });
        
        // Clear validation error when user starts typing
        namaKategori.addEventListener('input', function() {
            const errorElement = this.parentNode.parentNode.querySelector('.text-danger');
            if (errorElement) {
                errorElement.style.display = 'none';
            }
        });
    });
</script>

@endsection