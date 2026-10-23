<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login | Sistem Manajemen</title>
    <style>
        /* Kode CSS Anda yang sudah ada */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .shape-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(to right, #5c6bc0, #2da0a8);
            top: -250px;
            left: -100px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(to right, #2da0a8, #5c6bc0);
            bottom: -200px;
            right: -100px;
        }

        .shape-3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(to right, #5c6bc0, #2da0a8);
            top: 50%;
            left: 70%;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            z-index: 1;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #2da0a8;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .container button:hover {
            background-color: #23868e;
            transform: translateY(-2px);
        }

        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container button.hidden:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            transition: all 0.3s;
        }

        .container input:focus {
            box-shadow: 0 0 0 2px rgba(45, 160, 168, 0.3);
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .social-icons a:nth-child(1):hover {
            background-color: #DB4437;
            color: white;
            border-color: #DB4437;
        }

        .social-icons a:nth-child(2):hover {
            background-color: #4267B2;
            color: white;
            border-color: #4267B2;
        }

        .social-icons a:nth-child(3):hover {
            background-color: #333;
            color: white;
            border-color: #333;
        }

        .social-icons a:nth-child(4):hover {
            background-color: #0077B5;
            color: white;
            border-color: #0077B5;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background-color: #2da0a8;
            height: 100%;
            background: linear-gradient(to right, #5c6bc0, #2da0a8);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1001;
        }

        .language-selector select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: white;
            cursor: pointer;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1001;
        }

        .theme-toggle button {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px 30px;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            z-index: 1000;
            text-align: center;
            display: none;
            min-width: 300px;
        }

        .notification.show {
            display: block;
            animation: fadeInOut 3s forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
            20% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            80% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); display: none; }
        }

        .password-strength {
            width: 100%;
            height: 5px;
            background-color: #eee;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            border-radius: 3px;
            transition: width 0.3s, background-color 0.3s;
        }

        .password-hints {
            font-size: 11px;
            color: #777;
            margin-top: 5px;
            text-align: left;
            width: 100%;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 10px 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
            width: auto;
        }

        .dark-theme {
            background: linear-gradient(to right, #1a1a1a, #2c2c2c);
        }

        .dark-theme .container {
            background-color: #2a2a2a;
            color: #fff;
        }

        .dark-theme .container input {
            background-color: #3a3a3a;
            color: #fff;
        }

        .dark-theme .container a {
            color: #ddd;
        }

        .dark-theme .social-icons a {
            border-color: #555;
        }

        .laravel-form {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .laravel-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .laravel-form button {
            width: 100%;
            padding: 12px;
            background-color: #2da0a8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        .laravel-form button:hover {
            background-color: #23868e;
        }

        .laravel-form .link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                max-width: 100%;
                border-radius: 20px;
            }
            
            .toggle-container {
                display: none;
            }
            
            .sign-in, .sign-up {
                width: 100%;
            }
            
            .container.active .sign-in {
                transform: translateX(0);
                opacity: 0;
            }
            
            .container.active .sign-up {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .mobile-toggle {
            display: none !important;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            width: 100%;
            text-align: left;
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            width: 100%;
        }
        
        .alert-error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }
        
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }
    </style>
</head>
<body>
    <div class="background-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="language-selector">
        <select id="languageSelect">
            <option value="id" selected>Bahasa Indonesia</option>
            <option value="en">English</option>
            <option value="es">Español</option>
        </select>
    </div>

    <div class="theme-toggle">
        <button id="themeToggle"><i class="fas fa-moon"></i></button>
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <p id="notificationText">Login berhasil! Mengarahkan...</p>
    </div>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <h1 id="signInTitle">Masuk</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span id="loginEmailText">atau gunakan email dan kata sandi</span>
                
                <!-- Menampilkan error validasi -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-error">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>
                
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="Email">
                <div class="password-container">
                    <input id="password" type="password" name="password" required placeholder="Kata Sandi">
                    <span class="password-toggle" id="loginPasswordToggle">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" id="rememberMeLabel">Ingat saya</label>
                    </div>
                    <a href="#" id="forgotPasswordLink">Lupa Kata Sandi?</a>
                </div>
                
                <button type="submit">MASUK</button>
            </form>
        </div>
        
        <div class="form-container sign-up">
            <form action="<?php echo e(route('register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <h1 id="createAccountTitle">Buat Akun</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span id="registerEmailText">atau gunakan email untuk pendaftaran</span>
                
                <!-- Menampilkan error validasi -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-error">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <input type="text" placeholder="Nama" id="registerName" name="name" value="<?php echo e(old('name')); ?>" required />
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                
                <input type="email" placeholder="Email" id="registerEmail" name="email" value="<?php echo e(old('email')); ?>" required />
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                
                <div class="password-container">
                    <input type="password" placeholder="Kata Sandi" id="registerPassword" name="password" required />
                    <span class="password-toggle" id="registerPasswordToggle">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                
                <div class="password-container">
                    <input type="password" placeholder="Konfirmasi Kata Sandi" id="password_confirmation" name="password_confirmation" required />
                </div>
                
                <div class="password-strength">
                    <div class="strength-meter" id="passwordStrengthMeter"></div>
                </div>
                <div class="password-hints" id="passwordHints"></div>
                
                <button type="submit" id="signUpButton">Daftar</button>
            </form>
        </div>
        
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1 id="welcomeBackTitle">Selamat Datang Kembali!</h1>
                    <p id="welcomeBackText">Masukkan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1 id="helloFriendTitle">Halo, Teman!</h1>
                    <p id="helloFriendText">
                        Daftar dengan detail pribadi Anda untuk menggunakan semua fitur situs
                    </p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const container = document.getElementById("container");
        const registerBtn = document.getElementById("register");
        const loginBtn = document.getElementById("login");
        const themeToggle = document.getElementById("themeToggle");
        const languageSelect = document.getElementById("languageSelect");
        const notification = document.getElementById("notification");
        const notificationText = document.getElementById("notificationText");
        const registerPasswordToggle = document.getElementById("registerPasswordToggle");
        const loginPasswordToggle = document.getElementById("loginPasswordToggle");
        const registerPassword = document.getElementById("registerPassword");
        const loginPassword = document.getElementById("password");
        const passwordStrengthMeter = document.getElementById("passwordStrengthMeter");
        const passwordHints = document.getElementById("passwordHints");

        // Set default language to Indonesian
        changeLanguage('id');

        // Toggle between sign-in and sign-up
        registerBtn.addEventListener("click", () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener("click", () => {
            container.classList.remove("active");
        });

        // Theme toggle functionality
        themeToggle.addEventListener("click", () => {
            document.body.classList.toggle("dark-theme");
            if (document.body.classList.contains("dark-theme")) {
                themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });

        // Password visibility toggle
        registerPasswordToggle.addEventListener("click", () => {
            togglePasswordVisibility(registerPassword, registerPasswordToggle);
        });

        loginPasswordToggle.addEventListener("click", () => {
            togglePasswordVisibility(loginPassword, loginPasswordToggle);
        });

        function togglePasswordVisibility(passwordField, toggleButton) {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = '<i class="far fa-eye"></i>';
            }
        }

        // Password strength meter
        registerPassword.addEventListener("input", function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthMeter(strength);
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            let hints = [];

            // Length check
            if (password.length >= 8) strength += 20;
            else hints.push("Minimal 8 karakter");

            // Lowercase and uppercase check
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 20;
            else hints.push("Huruf kecil dan huruf besar");

            // Numbers check
            if (password.match(/([0-9])/)) strength += 20;
            else hints.push("Minimal satu angka");

            // Special characters check
            if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)) strength += 20;
            else hints.push("Minimal satu karakter khusus");

            // Common patterns (bonus)
            if (password.length > 10) strength += 20;

            // Update hints
            if (hints.length > 0) {
                passwordHints.textContent = "Perlu: " + hints.join(", ");
            } else {
                passwordHints.textContent = "Kata sandi kuat!";
            }

            return strength;
        }

        function updatePasswordStrengthMeter(strength) {
            passwordStrengthMeter.style.width = strength + '%';
            
            if (strength < 40) {
                passwordStrengthMeter.style.backgroundColor = '#e74c3c';
            } else if (strength < 80) {
                passwordStrengthMeter.style.backgroundColor = '#f39c12';
            } else {
                passwordStrengthMeter.style.backgroundColor = '#2ecc71';
            }
        }

        // Form validation and submission
        document.querySelector('.sign-in form').addEventListener('submit', function(e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });

        document.querySelector('.sign-up form').addEventListener('submit', function(e) {
            if (!validateRegisterForm()) {
                e.preventDefault();
            }
        });

        function validateLoginForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                showNotification('Harap isi semua bidang', 'error');
                return false;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Harap masukkan alamat email yang valid', 'error');
                return false;
            }
            
            return true;
        }

        function validateRegisterForm() {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            
            if (!name || !email || !password || !passwordConfirmation) {
                showNotification('Harap isi semua bidang', 'error');
                return false;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Harap masukkan alamat email yang valid', 'error');
                return false;
            }
            
            if (password.length < 8) {
                showNotification('Kata sandi harus minimal 8 karakter', 'error');
                return false;
            }
            
            if (password !== passwordConfirmation) {
                showNotification('Konfirmasi kata sandi tidak cocok', 'error');
                return false;
            }
            
            return true;
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function showNotification(message, type = 'success') {
            notificationText.textContent = message;
            notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Multi-language support
        languageSelect.addEventListener('change', function() {
            changeLanguage(this.value);
        });

        function changeLanguage(lang) {
            const translations = {
                en: {
                    createAccountTitle: 'Create Account',
                    registerEmailText: 'or use your email for registration',
                    signUpButton: 'Sign Up',
                    signInTitle: 'Sign In',
                    loginEmailText: 'or use your email password',
                    rememberMeLabel: 'Remember me',
                    forgotPasswordLink: 'Forget Your Password?',
                    signInButton: 'SIGN IN',
                    welcomeBackTitle: 'Welcome Back!',
                    welcomeBackText: 'Enter your personal details to use all of site features',
                    helloFriendTitle: 'Hello, Friend!',
                    helloFriendText: 'Register with your personal details to use all of site features'
                },
                id: {
                    createAccountTitle: 'Buat Akun',
                    registerEmailText: 'atau gunakan email untuk pendaftaran',
                    signUpButton: 'Daftar',
                    signInTitle: 'Masuk',
                    loginEmailText: 'atau gunakan kata sandi email Anda',
                    rememberMeLabel: 'Ingat saya',
                    forgotPasswordLink: 'Lupa Kata Sandi?',
                    signInButton: 'MASUK',
                    welcomeBackTitle: 'Selamat Datang Kembali!',
                    welcomeBackText: 'Masukkan detail pribadi Anda untuk menggunakan semua fitur situs',
                    helloFriendTitle: 'Halo, Teman!',
                    helloFriendText: 'Daftar dengan detail pribadi Anda untuk menggunakan semua fitur situs'
                }
            };

            const translation = translations[lang] || translations.id;
            
            for (const [key, value] of Object.entries(translation)) {
                const element = document.getElementById(key);
                if (element) {
                    element.textContent = value;
                }
            }
        }

        // Remember me functionality
        window.addEventListener('DOMContentLoaded', () => {
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            if (rememberedEmail) {
                document.getElementById('email').value = rememberedEmail;
                document.getElementById('remember').checked = true;
            }
        });

        document.getElementById('remember').addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem('rememberedEmail', document.getElementById('email').value);
            } else {
                localStorage.removeItem('rememberedEmail');
            }
        });
    </script>
</body>
</html><?php /**PATH D:\KULIAH\PKL\sembako_aldi\resources\views/auth/login.blade.php ENDPATH**/ ?>