<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - FoodOrder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 border border-gray-100">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto text-2xl mb-3">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Login Dashboard Admin</h2>
            <p class="text-gray-500 text-sm mt-1">Masukkan email & password untuk mengelola pesanan.</p>
        </div>

        <!-- Notifikasi Pesan -->
        <?php if (session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm mb-6">
                <?php echo session('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg text-sm mb-6">
                <?php echo session('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="<?php echo route('login.post'); ?>" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Admin</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <input type="email" name="email" required placeholder="admin@foodorder.com" class="w-full pl-10 pr-3 py-2.5 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 border-gray-300">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-key absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full pl-10 pr-3 py-2.5 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 border-gray-300">
                </div>
            </div>

            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-lg shadow-md transition">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="<?php echo route('home'); ?>" class="text-xs text-gray-500 hover:text-red-500 font-semibold">
                &larr; Kembali ke Website Utama
            </a>
        </div>

    </div>

</body>
</html>