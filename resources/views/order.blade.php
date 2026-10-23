<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madura Mart - Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --dark-color: #2d3748;
            --light-color: #f8f9fa;
            --border-radius: 1rem;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            padding-top: 80px;
            scroll-behavior: smooth;
        }

        .navbar {
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .logo-container {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .navbar.scrolled .logo-container {
            width: 35px;
            height: 35px;
        }

        .search-form {
            flex-grow: 1;
            max-width: 600px;
            position: relative;
        }

        .search-input {
            border-radius: 50px;
            padding-left: 20px;
            height: 48px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        .search-btn {
            border-radius: 50px;
            height: 48px;
            padding: 0 20px;
            background: var(--primary-gradient);
            border: none;
            transition: var(--transition);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 0 0 1rem 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            display: none;
        }

        .search-result-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            align-items: center;
            transition: background 0.2s;
            cursor: pointer;
        }

        .search-result-item:hover {
            background: #f8f9fa;
        }

        .search-result-item img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 12px;
        }

        .search-result-item .info {
            flex: 1;
        }

        .search-result-item .price {
            color: var(--primary-color);
            font-weight: 600;
        }

        .profile-img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            transition: var(--transition);
        }

        .navbar.scrolled .profile-img {
            width: 28px;
            height: 28px;
        }

        .cart-btn {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f8f9fa;
            transition: var(--transition);
            position: relative;
        }

        .cart-btn:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .navbar.scrolled .cart-btn {
            width: 42px;
            height: 42px;
        }

        .cart-badge {
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
            transition: var(--transition);
        }

        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
            color: #ccc;
            transition: var(--transition);
            z-index: 10;
        }

        .wishlist-btn.active, .wishlist-btn:hover {
            color: var(--danger-color);
        }

        .category-nav {
            padding: 1rem 0;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 80px;
            z-index: 990;
            transition: var(--transition);
        }

        .navbar.scrolled ~ .category-nav {
            top: 70px;
        }

        .category-btn {
            border-radius: 50px;
            padding: 8px 20px;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            transition: var(--transition);
            z-index: -1;
        }

        .category-btn:hover,
        .category-btn:focus {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .category-btn:hover::before,
        .category-btn:focus::before {
            left: 0;
        }

        .promo-countdown {
            background: var(--primary-gradient);
            color: white;
            padding: 10px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .countdown-timer {
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .carousel-container {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .carousel-img {
            height: 300px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            transition: var(--transition);
        }

        .carousel-control-prev {
            left: 15px;
        }

        .carousel-control-next {
            right: 15px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        .carousel-indicators button.active {
            width: 30px;
            border-radius: 6px;
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

        .category-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .category-header:hover {
            transform: translateX(5px);
        }

        .category-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .product-card {
            transition: var(--transition);
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius);
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow);
        }

        .product-img {
            height: 200px;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 600;
        }

        .product-stock {
            font-size: 0.85rem;
        }

        .stock-low {
            color: var(--danger-color);
            font-weight: 600;
        }

        .add-to-cart-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            transition: var(--transition);
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .add-to-cart-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .quick-view-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
            color: var(--dark-color);
            transition: var(--transition);
            z-index: 10;
            opacity: 0;
        }

        .product-card:hover .quick-view-btn {
            opacity: 1;
        }

        .quick-view-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .product-rating {
            display: flex;
            align-items: center;
            margin: 5px 0;
        }

        .rating-stars {
            color: #ffc107;
            margin-right: 5px;
        }

        .rating-count {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .recently-viewed-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .wishlist-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .wishlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .empty-wishlist {
            text-align: center;
            padding: 3rem;
        }

        .empty-wishlist i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        .wishlist-item {
            display: flex;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .wishlist-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .wishlist-item-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-right: 1.5rem;
        }

        .wishlist-item-content {
            flex: 1;
        }

        .wishlist-item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .remove-wishlist {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .remove-wishlist:hover {
            color: var(--danger-color);
            transform: scale(1.1);
        }

        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 3rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .social-icon {
            color: white;
            transition: var(--transition);
        }

        .social-icon:hover {
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-heading {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .footer-link {
            color: #cbd5e0;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .footer-link:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .footer-link i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .founder-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            transition: var(--transition);
        }

        .founder-img:hover {
            transform: scale(1.05);
            border-color: var(--secondary-color);
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            border: none;
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(102, 126, 234, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .notification-toast {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
        }

        .recommendation-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--primary-gradient);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 5;
        }

        .product-quick-actions {
            position: absolute;
            top: 50px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transition: var(--transition);
        }

        .product-card:hover .product-quick-actions {
            opacity: 1;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: bold;
            margin: 0 5px;
        }

        .filter-panel {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-group-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .price-range-slider {
            width: 100%;
            margin: 10px 0;
        }

        .price-range-values {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        @media (max-width: 992px) {
            .search-form {
                order: 3;
                margin-top: 1rem;
                max-width: 100%;
            }
            
            .navbar .container {
                flex-wrap: wrap;
            }
            
            .category-btn {
                margin-bottom: 0.5rem;
            }

            .wishlist-item {
                flex-direction: column;
            }

            .wishlist-item-img {
                width: 100%;
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .wishlist-item-actions {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                margin-top: 1rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .carousel-img {
                height: 200px;
            }
            
            .carousel-control-prev,
            .carousel-control-next {
                width: 40px;
                height: 40px;
            }

            .search-results {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                max-height: calc(100vh - 70px);
                border-radius: 0;
            }

            .wishlist-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .wishlist-header .btn {
                margin-top: 1rem;
                align-self: flex-end;
            }

            .category-nav {
                top: 70px;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <div class="notification-toast" id="notificationToast"></div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('order') }}">
                <div class="d-flex align-items-center">
                    <div class="logo-container">
                        <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                    <span class="fw-bold text-dark fs-4 ms-2">MADURA MART</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <form action="{{ route('search') }}" method="GET" class="search-form mx-auto" id="searchForm">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control search-input" id="searchInput" placeholder="Cari produk kebutuhan sehari-hari...">
                        <button class="btn search-btn" type="submit">
                            <i class="fas fa-search text-white"></i>
                        </button>
                    </div>
                    <div class="search-results" id="searchResults"></div>
                </form>

                <div class="d-flex align-items-center gap-3 ms-lg-3 mt-3 mt-lg-0">
                    <button class="btn btn-outline-secondary rounded-pill" id="darkModeToggle">
                        <i class="fas fa-moon"></i>
                    </button>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle border-0 rounded-pill d-flex align-items-center px-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(Auth::user()->foto ?? 'images/default_profile.png') }}" alt="Profile" class="rounded-circle profile-img me-2">
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu shadow-lg border-0 rounded-3 mt-2" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item py-2" href="profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item py-2" href="#" id="wishlist-link"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-3 px-md-4">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3 px-md-4">Register</a>
                        </div>
                    @endauth

                    <div class="position-relative">
                        <a href="keranjang" class="cart-btn">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </a>
                        <span id="cart-count" class="badge bg-danger cart-badge">0</span>
                    </div>

                    <div class="position-relative">
                        <a href="#" class="cart-btn" id="wishlist-btn">
                            <i class="fas fa-heart text-primary"></i>
                        </a>
                        <span id="wishlist-count" class="badge bg-danger cart-badge">0</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="promo-countdown">
        <div class="container">
            <span class="me-2">🛍️ Promo Spesial Berakhir Dalam:</span>
            <span class="countdown-timer" id="countdown">23:59:59</span>
        </div>
    </div>

    <div class="category-nav">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <a href="#bahan_pokok" class="category-btn text-decoration-none">
                            <i class="fas fa-grain me-2"></i>Bahan Pokok
                        </a>
                        <a href="#snack" class="category-btn text-decoration-none">
                            <i class="fas fa-cookie-bite me-2"></i>Snack
                        </a>
                        <a href="#minuman" class="category-btn text-decoration-none">
                            <i class="fas fa-cup me-2"></i>Minuman
                        </a>
                        <a href="#obat" class="category-btn text-decoration-none">
                            <i class="fas fa-pills me-2"></i>Obat
                        </a>
                        <a href="#alat_mandi" class="category-btn text-decoration-none">
                            <i class="fas fa-soap me-2"></i>Alat Mandi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container my-5 animate-fadeIn" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="carousel-container">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/teh.png" class="d-block w-100 carousel-img" alt="Promo spesial untuk pelanggan setia Madura Mart">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/1.jpg" class="d-block w-100 carousel-img" alt="Founder Madura Mart - Aldi Dwi Irawawan">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark mb-2 section-title d-inline-block">Produk Pilihan Kami</h2>
            <p class="text-muted">Kebutuhan sehari-hari dengan kualitas terbaik</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">

                @php
                    $categories = [
                        1 => ['id' => 'bahan_pokok', 'title' => 'Bahan Pokok', 'icon' => 'fa-grain'],
                        3 => ['id' => 'snack', 'title' => 'Snack', 'icon' => 'fa-cookie-bite'],
                        5 => ['id' => 'minuman', 'title' => 'Minuman', 'icon' => 'fa-cup'],
                        6 => ['id' => 'obat', 'title' => 'Obat', 'icon' => 'fa-pills'],
                        7 => ['id' => 'alat_mandi', 'title' => 'Alat Mandi', 'icon' => 'fa-soap'],
                    ];
                @endphp

                @foreach ($categories as $kategori_id => $category)
                    @if ($dataproduk->where('kategori_id', $kategori_id)->isNotEmpty())
                        <div id="{{ $category['id'] }}" class="mb-5 animate-fadeIn product-category" data-aos="fade-up">
                            <div class="category-header" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category['id'] }}" aria-expanded="true">
                                <div class="category-icon">
                                    <i class="fas {{ $category['icon'] }} text-white"></i>
                                </div>
                                <h3 class="fw-bold text-dark mb-0">{{ $category['title'] }}</h3>
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </div>
                            <div class="collapse show" id="collapse{{ $category['id'] }}">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 products-container">
                                    @foreach ($dataproduk->where('kategori_id', $kategori_id) as $data)
                                        <div class="col product-item" data-category="{{ $category['id'] }}" data-price="{{ $data->harga_jual }}" data-name="{{ $data->nama_produk }}" data-rating="{{ rand(35, 50)/10 }}" data-reviews="{{ rand(5, 50) }}" data-stock="{{ $data->stok }}">
                                            <div class="card product-card h-100">
                                                @if(rand(0, 10) > 7)
                                                    <span class="recommendation-badge">
                                                        <i class="fas fa-star me-1"></i>Rekomendasi
                                                    </span>
                                                @endif
                                                
                                                <div class="product-quick-actions">
                                                    <button class="wishlist-btn" data-id="{{ $data->id }}">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                    <button class="quick-view-btn" data-id="{{ $data->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <img src="{{ asset($data->foto) }}" class="card-img-top product-img" alt="{{ $data->nama_produk }}" loading="lazy">
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">{{ $data->nama_produk }}</h5>
                                                    
                                                    <div class="product-rating">
                                                        <div class="rating-stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= floor($data->rating ?? 4.2))
                                                                    <i class="fas fa-star"></i>
                                                                @elseif ($i == ceil($data->rating ?? 4.2) && ($data->rating ?? 4.2) != floor($data->rating ?? 4.2))
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="rating-count">({{ $data->reviews ?? rand(5, 50) }})</span>
                                                    </div>
                                                    
                                                    <p class="product-price fw-bold mt-auto">Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</p>
                                                    <p class="product-stock {{ $data->stok < 10 ? 'stock-low' : '' }}">
                                                        Stok: {{ $data->stok }} {{ $data->stok < 10 ? '- Hampir Habis!' : '' }}
                                                    </p>
                                                    
                                                    <div class="quantity-controls">
                                                        <button class="quantity-btn decrease-quantity" data-id="{{ $data->id }}">-</button>
                                                        <input type="number" class="quantity-input" id="quantity-{{ $data->id }}" value="1" min="1" max="{{ $data->stok }}" readonly>
                                                        <button class="quantity-btn increase-quantity" data-id="{{ $data->id }}">+</button>
                                                    </div>
                                                    
                                                    <button class="btn add-to-cart-btn mt-2" data-id="{{ $data->id }}" data-name="{{ $data->nama_produk }}" data-price="{{ $data->harga_jual }}" data-stok="{{ $data->stok }}" {{ $data->stok == 0 ? 'disabled' : '' }}>
                                                        <i class="fas fa-cart-plus me-2"></i>{{ $data->stok == 0 ? 'Stok Habis' : 'Tambah' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>

    <section class="container recently-viewed-section animate-fadeIn" id="recentlyViewedSection" style="display: none;" data-aos="fade-up">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark mb-2 section-title d-inline-block">Baru Saja Dilihat</h2>
            <p class="text-muted">Produk yang baru Anda lihat</p>
        </div>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-4" id="recentlyViewedContainer">
        </div>
    </section>

    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Wishlist Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="wishlist-items-container">
                    </div>
                    <div id="empty-wishlist" class="empty-wishlist" style="display: none;">
                        <i class="fas fa-heart"></i>
                        <h4>Wishlist Anda kosong</h4>
                        <p>Tambahkan produk yang Anda suka ke wishlist untuk menyimpannya di sini</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="quickViewContent">
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo">
                        <div class="logo-container me-3">
                            <i class="fas fa-shopping-bag text-white"></i>
                        </div>
                        <h5 class="fw-bold">Madura Mart</h5>
                    </div>
                    <p class="text-light">
                        Sebagai pusat sembako online terpercaya, kami menghadirkan kebutuhan sehari-hari
                        dengan kualitas terbaik dan harga terjangkau.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="https://youtube.com/shorts/bS6m7fex4bI?si=BLz8IW5XafSXVfos" class="social-icon">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <h6 class="footer-heading">Layanan Pelanggan</h6>
                    <a href="mailto:customer@maduramart.com" class="footer-link">
                        <i class="fas fa-envelope"></i>customer@maduramart.com
                    </a>
                    <a href="https://wa.me/6282331318598" class="footer-link">
                        <i class="fab fa-whatsapp"></i>+62 823 3131 8598
                    </a>
                    <div class="footer-link">
                        <i class="fas fa-clock"></i>24/7 Customer Support
                    </div>
                </div>

                <div class="col-md-4 mb-4 text-center">
                    <h6 class="footer-heading">Founder</h6>
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('images/aldiCEO.jpg') }}" alt="Founder Madura Mart" class="rounded-circle founder-img mb-2">
                        <p class="text-light mb-0">Aldi Dwi Irawan</p>
                        <small class="text-light">CEO & Founder</small>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">© 2024 Madura Mart. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-light text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            let recentlyViewed = JSON.parse(localStorage.getItem('recentlyViewed')) || [];

            const loadingOverlay = document.getElementById('loadingOverlay');
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            const backToTop = document.getElementById('backToTop');
            const cartCount = document.getElementById('cart-count');
            const wishlistCount = document.getElementById('wishlist-count');
            const countdownTimer = document.getElementById('countdown');
            const recentlyViewedSection = document.getElementById('recentlyViewedSection');
            const recentlyViewedContainer = document.getElementById('recentlyViewedContainer');
            const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
            const wishlistModal = new bootstrap.Modal(document.getElementById('wishlistModal'));
            const wishlistBtn = document.getElementById('wishlist-btn');
            const wishlistLink = document.getElementById('wishlist-link');
            const wishlistItemsContainer = document.getElementById('wishlist-items-container');
            const emptyWishlist = document.getElementById('empty-wishlist');
            const notificationToast = document.getElementById('notificationToast');
            const mainNavbar = document.getElementById('mainNavbar');
            const darkModeToggle = document.getElementById('darkModeToggle');

            function initDarkMode() {
                const isDarkMode = localStorage.getItem('darkMode') === 'true';
                if (isDarkMode) {
                    document.body.classList.add('dark-mode');
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                }
            }

            function toggleDarkMode() {
                document.body.classList.toggle('dark-mode');
                const isDarkMode = document.body.classList.contains('dark-mode');
                localStorage.setItem('darkMode', isDarkMode);
                
                if (isDarkMode) {
                    darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                } else {
                    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                }
            }

            function showNotification(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `alert alert-${type} alert-dismissible fade show`;
                toast.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                notificationToast.appendChild(toast);
                
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 5000);
            }

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 50) {
                    mainNavbar.classList.add('scrolled');
                } else {
                    mainNavbar.classList.remove('scrolled');
                }
                
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
            });

            function showLoading() {
                loadingOverlay.classList.add('active');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('active');
            }

            function updateCartCount() {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCount.innerText = totalItems;
            }

            function updateWishlistCount() {
                wishlistCount.innerText = wishlist.length;
            }

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
            }

            function saveWishlist() {
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                updateWishlistCount();
                
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const productId = btn.dataset.id;
                    if (wishlist.find(item => item.id === productId)) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

            function displayWishlistItems() {
                if (wishlist.length === 0) {
                    wishlistItemsContainer.style.display = 'none';
                    emptyWishlist.style.display = 'block';
                    return;
                }

                wishlistItemsContainer.style.display = 'block';
                emptyWishlist.style.display = 'none';
                wishlistItemsContainer.innerHTML = '';

                wishlist.forEach(item => {
                    const wishlistItem = document.createElement('div');
                    wishlistItem.className = 'wishlist-item';
                    wishlistItem.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="wishlist-item-img">
                        <div class="wishlist-item-content">
                            <h5>${item.name}</h5>
                            <p class="product-price fw-bold">${item.price}</p>
                        </div>
                        <div class="wishlist-item-actions">
                            <button class="remove-wishlist" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="btn btn-primary add-to-cart-from-wishlist mt-2" data-id="${item.id}" data-name="${item.name}" data-price="${item.price.replace(/\D/g, '')}">
                                <i class="fas fa-cart-plus me-2"></i>Tambah
                            </button>
                        </div>
                    `;
                    wishlistItemsContainer.appendChild(wishlistItem);
                });

                document.querySelectorAll('.remove-wishlist').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        removeFromWishlist(productId);
                    });
                });

                document.querySelectorAll('.add-to-cart-from-wishlist').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        const productName = this.dataset.name;
                        const productPrice = parseInt(this.dataset.price);
                        addToCartFromWishlist(productId, productName, productPrice);
                    });
                });
            }

            function removeFromWishlist(productId) {
                wishlist = wishlist.filter(item => item.id !== productId);
                saveWishlist();
                displayWishlistItems();
                
                showNotification('Produk dihapus dari wishlist', 'info');
            }

            function addToCartFromWishlist(productId, productName, productPrice) {
                addToCart(productId, productName, productPrice);
            }

            function addToCart(productId, productName, productPrice, productStok = 100, quantity = 1) {
                let existingProduct = cart.find(item => item.id === productId);

                if (existingProduct && (existingProduct.quantity + quantity) > productStok) {
                    showNotification(`Anda tidak bisa menambahkan lebih dari ${productStok} item untuk produk ini`, 'warning');
                    return;
                }

                if (existingProduct) {
                    existingProduct.quantity += quantity;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        stok: productStok,
                        quantity: quantity
                    });
                }

                saveCart();
                showNotification(`${quantity} ${productName} ditambahkan ke keranjang`, 'success');
            }

            function increaseQuantityHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.dataset.id;
                const quantityInput = document.getElementById(`quantity-${productId}`);
                const maxStock = parseInt(quantityInput.max);
                
                if (parseInt(quantityInput.value) < maxStock) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else {
                    showNotification(`Tidak dapat menambah lebih dari ${maxStock} item`, 'warning');
                }
            }

            function decreaseQuantityHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.dataset.id;
                const quantityInput = document.getElementById(`quantity-${productId}`);
                
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            }

            function addToCartHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productPrice = parseInt(this.dataset.price);
                const productStok = parseInt(this.dataset.stok);
                const quantity = parseInt(document.getElementById(`quantity-${productId}`).value);

                if (productStok === 0) {
                    showNotification(`Maaf, ${productName} sedang tidak tersedia`, 'error');
                    return;
                }

                if (quantity > productStok) {
                    showNotification(`Hanya tersedia ${productStok} item untuk ${productName}`, 'warning');
                    return;
                }

                addToCart(productId, productName, productPrice, productStok, quantity);
            }

            function wishlistHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.dataset.id;
                const productElement = this.closest('.product-item');
                const productName = productElement.querySelector('.card-title').innerText;
                const productPrice = productElement.querySelector('.product-price').innerText;
                const productImage = productElement.querySelector('.product-img').src;

                const existingItem = wishlist.find(item => item.id === productId);

                if (existingItem) {
                    wishlist = wishlist.filter(item => item.id !== productId);
                    this.classList.remove('active');
                    showNotification(`${productName} dihapus dari wishlist`, 'info');
                } else {
                    wishlist.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage
                    });
                    this.classList.add('active');
                    showNotification(`${productName} ditambahkan ke wishlist`, 'success');
                }

                saveWishlist();
            }

            function quickViewHandler(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.dataset.id;
                const productElement = this.closest('.product-item');
                const productName = productElement.querySelector('.card-title').innerText;
                const productPrice = productElement.querySelector('.product-price').innerText;
                const productImage = productElement.querySelector('.product-img').src;
                const productStock = productElement.querySelector('.product-stock').innerText;
                const productRating = productElement.dataset.rating;
                const productReviews = productElement.dataset.reviews;

                addToRecentlyViewed({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage
                });

                showQuickViewModal(productId, productName, productPrice, productImage, productStock, productRating, productReviews);
            }

            function showQuickViewModal(productId, productName, productPrice, productImage, productStock, productRating, productReviews) {
                const modalContent = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <img src="${productImage}" alt="${productName}" class="img-fluid rounded-3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>${productName}</h3>
                            <div class="product-rating mb-2">
                                <div class="rating-stars">
                                    ${generateStarRating(productRating)}
                                </div>
                                <span class="rating-count">(${productReviews} ulasan)</span>
                            </div>
                            <h4 class="text-primary my-3">${productPrice}</h4>
                            <p class="${productStock.includes('Hampir Habis') ? 'text-danger' : ''}">${productStock}</p>
                            <p>Deskripsi Produk</p>
                            
                            <div class="quantity-controls my-4">
                                <button class="quantity-btn decrease-quantity" data-id="${productId}">-</button>
                                <input type="number" class="quantity-input" id="modal-quantity-${productId}" value="1" min="1" max="${productStock.match(/\d+/)[0]}" readonly>
                                <button class="quantity-btn increase-quantity" data-id="${productId}">+</button>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex mt-4">
                                <button class="btn add-to-cart-btn flex-grow-1" data-id="${productId}" data-name="${productName}" data-price="${productPrice.replace(/\D/g, '')}" data-stok="${productStock.match(/\d+/)[0]}">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                                <button class="btn btn-outline-primary wishlist-btn" data-id="${productId}">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                document.getElementById('quickViewContent').innerHTML = modalContent;
                quickViewModal.show();
                
                document.querySelector('#quickViewContent .add-to-cart-btn').addEventListener('click', addToCartHandler);
                document.querySelector('#quickViewContent .wishlist-btn').addEventListener('click', wishlistHandler);
                
                document.querySelector('#quickViewContent .increase-quantity').addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const quantityInput = document.getElementById(`modal-quantity-${productId}`);
                    const maxStock = parseInt(quantityInput.max);
                    
                    if (parseInt(quantityInput.value) < maxStock) {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                    } else {
                        showNotification(`Tidak dapat menambah lebih dari ${maxStock} item`, 'warning');
                    }
                });
                
                document.querySelector('#quickViewContent .decrease-quantity').addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const quantityInput = document.getElementById(`modal-quantity-${productId}`);
                    
                    if (parseInt(quantityInput.value) > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                    }
                });
            }

            function generateStarRating(rating) {
                let stars = '';
                const fullStars = Math.floor(rating);
                const hasHalfStar = rating % 1 >= 0.5;
                
                for (let i = 1; i <= 5; i++) {
                    if (i <= fullStars) {
                        stars += '<i class="fas fa-star"></i>';
                    } else if (i === fullStars + 1 && hasHalfStar) {
                        stars += '<i class="fas fa-star-half-alt"></i>';
                    } else {
                        stars += '<i class="far fa-star"></i>';
                    }
                }
                
                return stars;
            }

            function addToRecentlyViewed(product) {
                const existingIndex = recentlyViewed.findIndex(item => item.id === product.id);
                
                if (existingIndex !== -1) {
                    recentlyViewed.splice(existingIndex, 1);
                }
                
                recentlyViewed.unshift(product);
                
                if (recentlyViewed.length > 5) {
                    recentlyViewed = recentlyViewed.slice(0, 5);
                }
                
                localStorage.setItem('recentlyViewed', JSON.stringify(recentlyViewed));
                
                displayRecentlyViewed();
            }

            function displayRecentlyViewed() {
                if (recentlyViewed.length > 0) {
                    recentlyViewedSection.style.display = 'block';
                    recentlyViewedContainer.innerHTML = '';
                    
                    recentlyViewed.forEach(product => {
                        const productHTML = `
                            <div class="col">
                                <div class="card product-card h-100">
                                    <img src="${product.image}" class="card-img-top product-img" alt="${product.name}" loading="lazy">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">${product.name}</h6>
                                        <p class="product-price fw-bold mt-auto">${product.price}</p>
                                        <button class="btn add-to-cart-btn mt-2" data-id="${product.id}" data-name="${product.name}" data-price="${product.price.replace(/\D/g, '')}">
                                            <i class="fas fa-cart-plus me-2"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        recentlyViewedContainer.innerHTML += productHTML;
                    });
                    
                    attachProductEventListeners();
                } else {
                    recentlyViewedSection.style.display = 'none';
                }
            }

            function attachProductEventListeners() {
                document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                    button.addEventListener('click', addToCartHandler);
                });
                
                document.querySelectorAll('.wishlist-btn').forEach(button => {
                    button.addEventListener('click', wishlistHandler);
                });
                
                document.querySelectorAll('.quick-view-btn').forEach(button => {
                    button.addEventListener('click', quickViewHandler);
                });
                
                document.querySelectorAll('.increase-quantity').forEach(button => {
                    button.addEventListener('click', increaseQuantityHandler);
                });
                
                document.querySelectorAll('.decrease-quantity').forEach(button => {
                    button.addEventListener('click', decreaseQuantityHandler);
                });
            }

            function updateCountdown() {
                const now = new Date();
                const endOfDay = new Date();
                endOfDay.setHours(23, 59, 59, 999);
                
                const diff = endOfDay - now;
                
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                
                countdownTimer.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }
            
            setInterval(updateCountdown, 1000);
            updateCountdown();

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        const headerOffset = 100;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            updateCartCount();
            updateWishlistCount();
            initDarkMode();
            displayRecentlyViewed();

            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    displayWishlistItems();
                    wishlistModal.show();
                });
            }

            if (wishlistLink) {
                wishlistLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    displayWishlistItems();
                    wishlistModal.show();
                });
            }

            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', toggleDarkMode);
            }

            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', addToCartHandler);
            });

            document.querySelectorAll('.wishlist-btn').forEach(button => {
                const productId = button.dataset.id;
                if (wishlist.find(item => item.id === productId)) {
                    button.classList.add('active');
                }

                button.addEventListener('click', wishlistHandler);
            });

            document.querySelectorAll('.quick-view-btn').forEach(button => {
                button.addEventListener('click', quickViewHandler);
            });

            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', increaseQuantityHandler);
            });

            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', decreaseQuantityHandler);
            });

            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>