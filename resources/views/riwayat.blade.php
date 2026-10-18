<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - FoodOrder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-500 flex items-center gap-2">
                <i class="fa-solid fa-utensils"></i> FoodOrder
            </h1>
            <nav class="flex gap-6 font-semibold">
                <a href="<?php echo route('home'); ?>" class="hover:text-red-500">Menu Utama</a>
                <a href="<?php echo route('riwayat'); ?>" class="text-red-500 border-b-2 border-red-500">Riwayat Pesanan</a>
                <a href="<?php echo route('admin'); ?>" class="hover:text-red-500 text-gray-500">Dashboard Admin</a>
            </nav>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 pb-2 border-b-2 border-red-500 inline-block">Daftar Riwayat Pesanan</h2>

        <?php if (session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <?php echo session('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($orders->isEmpty()): ?>
            <div class="bg-white p-8 rounded-xl shadow-md text-center">
                <p class="text-gray-500">Belum ada pesanan yang dibuat.</p>
                <a href="<?php echo route('home'); ?>" class="inline-block mt-4 bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition">Pesan Makanan Sekarang</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach($orders as $order): ?>
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="flex justify-between items-start border-b pb-4 mb-4">
                            <div>
                                <span class="text-xs text-gray-400">ID Pesanan: #<?php echo $order->id; ?></span>
                                <h3 class="text-lg font-bold text-gray-900"><?php echo $order->nama_pemesan; ?></h3>
                                <p class="text-xs text-gray-500"><?php echo $order->created_at->format('d M Y, H:i'); ?></p>
                            </div>
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">
                                <?php echo $order->status; ?>
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <?php foreach($order->items as $item): ?>
                                <div class="flex justify-between text-sm">
                                    <span><?php echo $item->menu ? $item->menu->nama : 'Menu dihapus'; ?> x <?php echo $item->jumlah; ?></span>
                                    <span class="font-semibold">Rp<?php echo number_format($item->harga * $item->jumlah, 0, ',', '.'); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="border-t pt-3 flex justify-between items-center text-sm">
                            <span class="text-gray-500">Metode: <?php echo $order->metode_pembayaran; ?></span>
                            <span class="text-base font-bold text-red-600">Total: Rp<?php echo number_format($order->total_harga, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>