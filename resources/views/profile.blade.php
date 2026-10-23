<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madura Mart - Orders & Profile</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --dark-color: #2d3748;
            --light-color: #f8f9fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --border-radius: 1rem;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin: 20px;
            overflow: hidden;
        }
        
        .sidebar {
            width: 300px;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: relative;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }
        
        .sidebar-content {
            position: relative;
            z-index: 1;
        }
        
        .user-info-sidebar {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .nav-pills .nav-link {
            color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            margin-bottom: 8px;
            padding: 12px 15px;
            transition: var(--transition);
            border: 1px solid transparent;
        }
        
        .nav-pills .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        .nav-pills .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .profile-image-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-image {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }
        
        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }
        
        .profile-image-edit {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .tab-content {
            min-height: 80vh;
        }
        
        .tab-pane {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card-custom {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-header-custom {
            background: var(--primary-gradient);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 15px 20px;
            border: none;
        }
        
        .form-control-custom {
            border-radius: 10px;
            border: 1px solid #e1e5e9;
            padding: 12px 15px;
            transition: var(--transition);
        }
        
        .form-control-custom:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
        }
        
        .btn-custom {
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
        }
        
        .btn-primary-custom {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        .map-container {
            height: 350px;
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border-left: 4px solid var(--primary-color);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0;
        }
        
        .stat-label {
            color: var(--dark-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .transaction-table {
            font-size: 0.9rem;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .transaction-table th {
            background: var(--primary-gradient);
            color: white;
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        
        .transaction-table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        
        .transaction-table tbody tr {
            transition: var(--transition);
        }
        
        .transaction-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }
        
        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        
        .suggestions-list {
            position: absolute;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--dark-color);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            cursor: pointer;
            z-index: 1000;
            transition: var(--transition);
        }
        
        .floating-action-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .progress-bar-custom {
            height: 8px;
            border-radius: 10px;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--primary-gradient);
            border-radius: 10px;
            transition: width 0.5s ease;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }
        
        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--primary-color);
        }
        
        .timeline-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 3px solid var(--primary-color);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
            }
            
            .d-flex {
                flex-direction: column;
            }
            
            .profile-image {
                width: 100px;
                height: 100px;
            }
            
            .main-container {
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Action Button -->
    <div class="floating-action-btn" id="scrollToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <div class="main-container d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4">
            <div class="sidebar-content">
                <!-- User Info in Sidebar -->
                <div class="user-info-sidebar text-center mb-4">
                    <div class="profile-image-container mb-3">
                        <img id="preview-image" 
                             src="{{ asset($user->foto ?? 'images/default_profile.png') }}" 
                             alt="Foto Profil" 
                             class="profile-image rounded-circle">
                        <div class="profile-image-edit" onclick="document.getElementById('foto').click()">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="mb-2 opacity-75">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center">
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            <i class="fas fa-star text-warning me-1"></i>
                            Member Gold
                        </span>
                    </div>
                </div>
                
                <a class="btn btn-outline-light w-100 mb-4 btn-custom" href="{{ url('order') }}">
                    <i class="fas fa-arrow-left me-2"></i>KEMBALI KE TOKO
                </a>
                
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item position-relative">
                        <a class="nav-link active" id="update-tab" data-bs-toggle="pill" href="#update-content">
                            <i class="fas fa-user me-2"></i>Akun Saya
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" id="histori-tab" data-bs-toggle="pill" href="#histori-content">
                            <i class="fas fa-spinner me-2"></i>Pending
                            @if($dataTransaksi->where('status','pending')->count() > 0)
                            <span class="notification-badge">{{ $dataTransaksi->where('status','pending')->count() }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dikirim-tab" data-bs-toggle="pill" href="#dikirim-content">
                            <i class="fas fa-truck-fast me-2"></i>Dikirim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="diterima-tab" data-bs-toggle="pill" href="#diterima-content">
                            <i class="fas fa-check-circle me-2"></i>Diterima
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="statistik-tab" data-bs-toggle="pill" href="#statistik-content">
                            <i class="fas fa-chart-bar me-2"></i>Statistik
                        </a>
                    </li>
                </ul>
                
                <!-- Quick Stats in Sidebar -->
                <div class="mt-5 pt-4">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="text-white">
                                <h4 class="mb-0">{{ $dataTransaksi->count() }}</h4>
                                <small>Total Pesanan</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-white">
                                <h4 class="mb-0">Rp {{ number_format($dataTransaksi->sum('harga'), 0, ',', '.') }}</h4>
                                <small>Total Belanja</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-grow-1 p-4">
            <div class="tab-content">
                <!-- Tab Profil -->
                <div class="tab-pane fade show active" id="update-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0 fw-bold">Profil Saya</h3>
                        <div class="d-flex">
                            <span class="badge bg-primary me-2">Aktif</span>
                            <span class="badge bg-success">Terverifikasi</span>
                        </div>
                    </div>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-custom mb-4">
                                <div class="card-header card-header-custom">
                                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Informasi Pribadi</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                                        @csrf
                                        
                                        <input type="file" name="foto" accept="image/*" class="d-none" id="foto">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-custom" name="name" id="name" 
                                                           value="{{ old('name', $user->name) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-control-custom" name="email" id="email" 
                                                           value="{{ old('email', $user->email) }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-custom" name="password" id="password" 
                                                       placeholder="Kosongkan jika tidak ingin diubah">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="progress-bar-custom mt-2">
                                                <div class="progress-fill" id="passwordStrength" style="width: 0%"></div>
                                            </div>
                                            <div class="form-text">Minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-custom" name="alamat" id="alamat" 
                                                       value="{{ old('alamat', $user->alamat) }}" 
                                                       oninput="cariRekomendasi(this.value)" required>
                                                <button type="button" class="btn btn-info" onclick="cariLokasi()">
                                                    <i class="fas fa-search me-1"></i>Cari
                                                </button>
                                            </div>
                                            <div id="suggestions" class="suggestions-list"></div>
                                        </div>

                                        <div class="mb-4">
                                            <p id="koordinat" class="text-muted"></p>
                                            <div id="map" class="map-container"></div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary-custom btn-custom">
                                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <!-- Stat Cards -->
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="stat-card">
                                        <h3 class="stat-number">{{ $dataTransaksi->where('status', 'selesai')->count() }}</h3>
                                        <p class="stat-label">Pesanan Selesai</p>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="stat-card">
                                        <h3 class="stat-number">{{ $dataTransaksi->where('status', 'dikirim')->count() }}</h3>
                                        <p class="stat-label">Sedang Dikirim</p>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="stat-card">
                                        <h3 class="stat-number">{{ $dataTransaksi->where('status', 'pending')->count() }}</h3>
                                        <p class="stat-label">Menunggu Pembayaran</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Profile Completion -->
                            <div class="card card-custom">
                                <div class="card-header card-header-custom">
                                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Kelengkapan Profil</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Profil Dasar</span>
                                            <span>80%</span>
                                        </div>
                                        <div class="progress-bar-custom">
                                            <div class="progress-fill" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Informasi Alamat</span>
                                            <span>60%</span>
                                        </div>
                                        <div class="progress-bar-custom">
                                            <div class="progress-fill" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Verifikasi Email</span>
                                            <span>100%</span>
                                        </div>
                                        <div class="progress-bar-custom">
                                            <div class="progress-fill" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Pending -->
                <div class="tab-pane fade" id="histori-content">
                    <h3 class="mb-4 fw-bold">Pesanan Pending</h3>
                    
                    @if($dataTransaksi->where('status','pending')->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover transaction-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Status</th>
                                    <th class="text-end">Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaksi->where('status','pending')->sortByDesc('created_at') as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>
                                        <span class="badge badge-custom bg-warning text-dark">{{ ucfirst($transaction->status) }}</span>
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $transaction->id }}">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                        <button class="btn btn-success btn-sm bayar-transaksi ms-1" 
                                                data-snap-token="{{ $transaction->snap_token }}"
                                                data-transaction-id="{{ $transaction->id }}">
                                            <i class="fas fa-credit-card me-1"></i>Bayar
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h4 class="mt-3">Tidak ada pesanan pending</h4>
                        <p class="text-muted">Semua pesanan Anda telah diproses atau dibayar</p>
                    </div>
                    @endif
                </div>

                <!-- Tab Dikirim -->
                <div class="tab-pane fade" id="dikirim-content">
                    <h3 class="mb-4 fw-bold">Pesanan Dikirim</h3>
                    
                    @if($dataTransaksi->where('status','dikirim')->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover transaction-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Status</th>
                                    <th class="text-end">Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaksi->where('status','dikirim')->sortByDesc('created_at') as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>
                                        <span class="badge badge-custom bg-info">{{ ucfirst($transaction->status) }}</span>
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $transaction->id }}">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-shipping-fast"></i>
                        <h4 class="mt-3">Tidak ada pesanan yang sedang dikirim</h4>
                        <p class="text-muted">Pesanan Anda akan muncul di sini ketika sedang dalam pengiriman</p>
                    </div>
                    @endif
                </div>

                <!-- Tab Diterima -->
                <div class="tab-pane fade" id="diterima-content">
                    <h3 class="mb-4 fw-bold">Pesanan Diterima</h3>
                    
                    @if($dataTransaksi->where('status','selesai')->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover transaction-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Status</th>
                                    <th class="text-end">Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaksi->where('status','selesai')->sortByDesc('created_at') as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>
                                        <span class="badge badge-custom bg-success">{{ ucfirst($transaction->status) }}</span>
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $transaction->id }}">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm ms-1" onclick="pesanLagi({{ $transaction->id }})">
                                            <i class="fas fa-redo me-1"></i>Pesan Lagi
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h4 class="mt-3">Tidak ada pesanan yang telah diterima</h4>
                        <p class="text-muted">Pesanan yang telah Anda terima akan muncul di sini</p>
                    </div>
                    @endif
                </div>

                <!-- Tab Statistik -->
                <div class="tab-pane fade" id="statistik-content">
                    <h3 class="mb-4 fw-bold">Statistik Pesanan</h3>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-custom mb-4">
                                <div class="card-header card-header-custom">
                                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Grafik Pesanan</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="orderChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom mb-4">
                                <div class="card-header card-header-custom">
                                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Status Pesanan</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-header card-header-custom">
                                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Aktivitas</h5>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content">
                                                <h6>Pembaruan Profil</h6>
                                                <p class="text-muted mb-0">Anda memperbarui informasi profil</p>
                                                <small class="text-muted">2 jam yang lalu</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6>Pesanan Diterima</h6>
                                                <p class="text-muted mb-0">Pesanan #{{ $dataTransaksi->where('status','selesai')->sortByDesc('created_at')->first()->id ?? '12345' }} telah diterima</p>
                                                <small class="text-muted">1 hari yang lalu</small>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-info"></div>
                                            <div class="timeline-content">
                                                <h6>Pesanan Dikirim</h6>
                                                <p class="text-muted mb-0">Pesanan #{{ $dataTransaksi->where('status','dikirim')->sortByDesc('created_at')->first()->id ?? '12346' }} sedang dikirim</p>
                                                <small class="text-muted">3 hari yang lalu</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Transaksi -->
    @foreach ($dataTransaksi as $transaction)
    <div class="modal fade" id="detailModal-{{ $transaction->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $transaction->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel-{{ $transaction->id }}">Detail Pesanan #{{ $transaction->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID Pesanan:</strong> {{ $transaction->id }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge 
                                    @if($transaction->status == 'pending') bg-warning text-dark
                                    @elseif($transaction->status == 'dikirim') bg-info
                                    @elseif($transaction->status == 'selesai') bg-success
                                    @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </p>
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->harga, 0, ',', '.') }}</p>
                            @if($transaction->tanggal_bayar)
                            <p><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($transaction->tanggal_bayar)->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h6>Detail Produk:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->details as $detail)
                                <tr>
                                    <td>{{ $detail->produk->nama_produk }}</td>
                                    <td class="text-center">{{ $detail->jumlah }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Ongkir:</strong></td>
                                    <td class="text-end">Rp 16.000</td>
                                </tr>
                                <tr class="table-active">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong>Rp {{ number_format($transaction->harga, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    @if($transaction->status == 'pending')
                    <div class="d-grid mt-3">
                        <button class="btn btn-success btn-custom bayar-transaksi" 
                                data-snap-token="{{ $transaction->snap_token }}"
                                data-transaction-id="{{ $transaction->id }}">
                            <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                        </button>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([-7.8024121, 111.98003444926701], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        
        var marker;
        
        // Preview gambar profil
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
        
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            if (/[^A-Za-z0-9]/.test(password)) strength += 25;
            
            document.getElementById('passwordStrength').style.width = strength + '%';
            
            // Change color based on strength
            const progressFill = document.getElementById('passwordStrength');
            if (strength < 50) {
                progressFill.style.background = 'linear-gradient(90deg, #dc3545, #e35d6a)';
            } else if (strength < 75) {
                progressFill.style.background = 'linear-gradient(90deg, #ffc107, #ffd54f)';
            } else {
                progressFill.style.background = 'var(--primary-gradient)';
            }
        });
        
        // Fungsi pencarian rekomendasi alamat
        function cariRekomendasi(query) {
            if (query.length < 3) {
                document.getElementById('suggestions').innerHTML = "";
                return;
            }
            
            let url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&bounded=1&viewbox=110.55,-5.85,114.62,-9.0`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let suggestionBox = document.getElementById('suggestions');
                    suggestionBox.innerHTML = "";
                    
                    if (data.length === 0) {
                        let li = document.createElement("li");
                        li.classList.add("list-group-item", "text-muted");
                        li.textContent = "Tidak ada rekomendasi ditemukan";
                        suggestionBox.appendChild(li);
                        return;
                    }
                    
                    data.forEach(item => {
                        let li = document.createElement("li");
                        li.classList.add("list-group-item", "list-group-item-action");
                        li.style.cursor = "pointer";
                        li.innerHTML = `<small>${item.display_name}</small>`;
                        li.onclick = function() {
                            document.getElementById('alamat').value = item.display_name;
                            suggestionBox.innerHTML = "";
                            tampilkanLokasi(item.lat, item.lon, item.display_name);
                        };
                        suggestionBox.appendChild(li);
                    });
                })
                .catch(error => {
                    console.error("Error fetching suggestions:", error);
                    let suggestionBox = document.getElementById('suggestions');
                    suggestionBox.innerHTML = "";
                    let li = document.createElement("li");
                    li.classList.add("list-group-item", "text-danger");
                    li.textContent = "Terjadi kesalahan saat mengambil rekomendasi";
                    suggestionBox.appendChild(li);
                });
        }
        
        // Fungsi pencarian lokasi
        function cariLokasi() {
            var alamat = document.getElementById("alamat").value.trim();
            
            if (alamat === "") {
                alert("Masukkan alamat terlebih dahulu!");
                return;
            }
            
            var apiUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}`;
            
            fetch(apiUrl, {
                headers: {
                    'User-Agent': 'my-app'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Gagal mengambil data lokasi. Coba lagi nanti.");
                }
                return response.json();
            })
            .then(data => {
                if (data.length === 0) {
                    alert("Lokasi tidak ditemukan! Coba masukkan alamat yang lebih spesifik.");
                    return;
                }
                
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                document.getElementById("koordinat").innerText = `Koordinat: ${lat}, ${lon}`;
                
                // Update tampilan peta
                map.setView([lat, lon], 15);
                
                // Hapus marker lama jika ada
                if (marker) {
                    map.removeLayer(marker);
                }
                
                // Tambahkan marker baru
                marker = L.marker([lat, lon]).addTo(map)
                    .bindPopup(`<b>Lokasi:</b><br>${alamat}`)
                    .openPopup();
            })
            .catch(error => {
                console.error("Error:", error);
                alert(error.message);
            });
        }
        
        // Fungsi untuk menampilkan lokasi di peta
        function tampilkanLokasi(lat, lon, alamat) {
            document.getElementById("koordinat").innerText = `Koordinat: ${lat}, ${lon}`;
            
            // Update tampilan peta
            map.setView([lat, lon], 15);
            
            // Hapus marker lama jika ada
            if (marker) {
                map.removeLayer(marker);
            }
            
            // Tambahkan marker baru
            marker = L.marker([lat, lon]).addTo(map)
                .bindPopup(`<b>Lokasi:</b><br>${alamat}`)
                .openPopup();
        }
        
        // Integrasi pembayaran Midtrans
        document.querySelectorAll('.bayar-transaksi').forEach(button => {
            button.addEventListener('click', function() {
                let snapToken = this.getAttribute('data-snap-token');
                let transactionId = this.getAttribute('data-transaction-id');
                
                if (!snapToken) {
                    alert("Token pembayaran tidak tersedia.");
                    return;
                }
                
                window.snap.pay(snapToken, {
                    onSuccess: function(result) {
                        console.log('Payment Success:', result);
                        alert("Pembayaran berhasil!");
                        
                        // Kirim request ke backend untuk update status
                        fetch("{{ route('update.status') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                transaction_id: transactionId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log("Status transaksi diperbarui:", data);
                            location.reload();
                        })
                        .catch(error => console.error("Error:", error));
                    },
                    onPending: function(result) {
                        console.log('Payment Pending:', result);
                        alert("Pembayaran tertunda. Silakan selesaikan pembayaran Anda.");
                    },
                    onError: function(result) {
                        console.log('Payment Failed:', result);
                        alert("Pembayaran gagal. Silakan coba lagi.");
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                    }
                });
            });
        });
        
        // Fungsi pesan lagi (placeholder)
        function pesanLagi(transactionId) {
            alert('Fitur "Pesan Lagi" akan segera tersedia!');
            // Implementasi untuk memesan ulang produk dari transaksi ini
        }
        
        // Scroll to top functionality
        document.getElementById('scrollToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Order Chart
            const orderCtx = document.getElementById('orderChart').getContext('2d');
            const orderChart = new Chart(orderCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pesanan',
                        data: [12, 19, 8, 15, 12, 17, 10, 15, 13, 18, 14, 16],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Dikirim', 'Pending'],
                    datasets: [{
                        data: [
                            {{ $dataTransaksi->where('status','selesai')->count() }},
                            {{ $dataTransaksi->where('status','dikirim')->count() }},
                            {{ $dataTransaksi->where('status','pending')->count() }}
                        ],
                        backgroundColor: [
                            '#10b981',
                            '#0dcaf0',
                            '#ffc107'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
        
        // Validasi form sebelum submit
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            
            if (!name || !email || !alamat) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
                return;
            }
            
            // Validasi email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Format email tidak valid!');
                return;
            }
        });
    </script>
</body>
</html>