<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #2f8652;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .card .logo img {
            max-width: 160px;
            margin-bottom: 20px;
        }

        .card h2 {
            margin-bottom: 25px;
            font-size: 26px;
            color: #222;
        }

        .card input[type="email"],
        .card input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .card input:focus {
            border-color: #2f8652;
            outline: none;
        }

        .card button {
            width: 100%;
            padding: 12px;
            background-color: #2f8652;
            color: white;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card button:hover {
            background-color: #256b42;
        }

        .card .link {
            margin-top: 20px;
            font-size: 14px;
        }

        .card .link a {
            color: #2f8652;
            font-weight: bold;
            text-decoration: none;
        }

        .card .link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo IRAWAN">
        </div>

        <h2>Login</h2>

        
        <?php if($errors->any()): ?>
            <div style="color: red; margin-bottom: 15px; text-align: left;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
            </div>
            <div>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <div class="link">
            Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar</a>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\Users\acer\OneDrive\เอกสาร\sembako_aldi\resources\views/auth/login.blade.php ENDPATH**/ ?>