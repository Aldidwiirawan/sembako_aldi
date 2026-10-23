<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-section {
            flex: 1;
            padding: 40px;
        }

        .welcome-section {
            flex: 1;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .logo i {
            font-size: 36px;
            color: #4f46e5;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #1f2937;
        }

        .welcome-section h1 {
            color: white;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .welcome-section .subtitle {
            color: rgba(255, 255, 255, 0.9);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-register:hover {
            background: white;
            color: #4f46e5;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            font-size: 14px;
        }

        .remember {
            display: flex;
            align-items: center;
        }

        .remember input {
            margin-right: 8px;
        }

        .forgot-password {
            color: #4f46e5;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #6b7280;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider::before {
            margin-right: 10px;
        }

        .divider::after {
            margin-left: 10px;
        }

        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 20px;
            background: #ef4444;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: none;
            z-index: 1000;
            text-align: center;
            max-width: 90%;
        }

        .notification.success {
            background: #10b981;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .welcome-section {
                order: -1;
                padding: 30px;
            }
            
            .login-section {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="notification" id="notification">
        <span id="notificationText"></span>
    </div>

    <div class="container">
        <div class="login-section">
            <div class="logo">
                <i class="fas fa-lock"></i>
            </div>
            <h1>Masuk</h1>
            <p class="subtitle">atau gunakan kata sandi email Anda</p>

            <form id="loginForm">
                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" class="form-control" placeholder="owner@gmail.com" value="owner@gmail.com" required>
                    </div>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan kata sandi" required>
                        <i class="fas fa-eye password-toggle" id="passwordToggle"></i>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <div class="remember-forgot">
                    <div class="remember">
                        <input type="checkbox" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-password">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="btn-login" id="loginButton">
                    <span class="button-text">MASUK</span>
                </button>

                <div class="divider"></div>
            </form>
        </div>

        <div class="welcome-section">
            <h1>Halo, Teman!</h1>
            <p class="subtitle">Daftar dengan detail pribadi Anda untuk menggunakan semua fitur situs</p>
            <button class="btn-register" id="registerButton">DAFTAR</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            const loginButton = document.getElementById('loginButton');
            const registerButton = document.getElementById('registerButton');
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            // Toggle password visibility
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.remove('fa-eye');
                    passwordToggle.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.remove('fa-eye-slash');
                    passwordToggle.classList.add('fa-eye');
                }
            });

            // Redirect to register page
            registerButton.addEventListener('click', function() {
                window.location.href = '/register';
            });

            // Handle form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Reset errors
                emailError.style.display = 'none';
                passwordError.style.display = 'none';
                
                // Get form values
                const email = emailInput.value.trim();
                const password = passwordInput.value;
                const remember = document.getElementById('remember').checked;
                
                // Validate form
                let isValid = true;
                
                if (!email) {
                    emailError.textContent = 'Email harus diisi';
                    emailError.style.display = 'block';
                    isValid = false;
                } else if (!isValidEmail(email)) {
                    emailError.textContent = 'Format email tidak valid';
                    emailError.style.display = 'block';
                    isValid = false;
                }
                
                if (!password) {
                    passwordError.textContent = 'Kata sandi harus diisi';
                    passwordError.style.display = 'block';
                    isValid = false;
                } else if (password.length < 6) {
                    passwordError.textContent = 'Kata sandi minimal 6 karakter';
                    passwordError.style.display = 'block';
                    isValid = false;
                }
                
                if (!isValid) return;
                
                // Show loading state
                loginButton.disabled = true;
                loginButton.innerHTML = '<div class="spinner"></div> Memproses...';
                
                // Simulate login process
                simulateLogin(email, password, remember);
            });

            // Email validation function
            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Simulate login process
            function simulateLogin(email, password, remember) {
                // This is a simulation - in a real application, you would send a request to your server
                setTimeout(() => {
                    // Check for specific credentials to simulate different scenarios
                    if (email === 'admin@example.com' && password === 'password') {
                        showNotification('Login berhasil! Mengarahkan ke dashboard admin...', 'success');
                        // Redirect to admin dashboard
                        setTimeout(() => {
                            window.location.href = '/admin';
                        }, 2000);
                    } else if (email === 'owner@gmail.com' && password === 'password') {
                        showNotification('Login berhasil! Mengarahkan ke dashboard owner...', 'success');
                        // Redirect to owner dashboard
                        setTimeout(() => {
                            window.location.href = '/owner';
                        }, 2000);
                    } else if (email === 'pembeli@example.com' && password === 'password') {
                        showNotification('Login berhasil! Mengarahkan ke halaman order...', 'success');
                        // Redirect to order page
                        setTimeout(() => {
                            window.location.href = '/order';
                        }, 2000);
                    } else if (email === 'user@example.com' && password === 'password') {
                        showNotification('Login berhasil! Mengarahkan ke halaman utama...', 'success');
                        // Redirect to home page
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    } else {
                        showNotification('Email atau kata sandi salah. Silakan coba lagi.');
                        resetLoginButton();
                    }
                }, 1500);
            }

            // Show notification
            function showNotification(message, type = 'error') {
                notificationText.textContent = message;
                notification.className = 'notification';
                if (type === 'success') {
                    notification.classList.add('success');
                }
                notification.style.display = 'block';
                
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }

            // Reset login button to original state
            function resetLoginButton() {
                loginButton.disabled = false;
                loginButton.innerHTML = '<span class="button-text">MASUK</span>';
            }

            // Check if there's a remembered email
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            if (rememberedEmail) {
                emailInput.value = rememberedEmail;
                document.getElementById('remember').checked = true;
            }

            // Remember email if "Remember me" is checked
            document.getElementById('remember').addEventListener('change', function() {
                if (this.checked && emailInput.value) {
                    localStorage.setItem('rememberedEmail', emailInput.value);
                } else {
                    localStorage.removeItem('rememberedEmail');
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\Users\acer\Videos\sembako_aldi\resources\views/auth/register.blade.php ENDPATH**/ ?>