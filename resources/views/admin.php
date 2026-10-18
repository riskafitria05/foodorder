<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - FoodOrder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header / Navbar -->
    <header class="bg-gray-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center gap-2 text-red-400">
                <i class="fa-solid fa-user-shield"></i> Dashboard Admin
            </h1>
            <nav class="flex gap-6 font-semibold text-sm">
                <a href="<?php echo route('home'); ?>" class="hover:text-red-400">Ke Website Utama</a>
                <a href="<?php echo route('riwayat'); ?>" class="hover:text-red-400">Riwayat Pesanan</a>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Kelola Pesanan Masuk</h2>

        <?php if (session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <?php echo session('success'); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-100 border-b text-gray-700 font-bold">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Pemesan</th>
                        <th class="p-4">Alamat & Telp</th>
                        <th class="p-4">Detail Pesanan</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php foreach($orders as $order): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-bold">#<?php echo $order->id; ?></td>
                            <td class="p-4 font-semibold"><?php echo $order->nama_pemesan; ?></td>
                            <td class="p-4 text-xs">
                                <p><?php echo $order->nomor_telepon; ?></p>
                                <p class="text-gray-500"><?php echo $order->alamat; ?></p>
                            </td>
                            <td class="p-4 text-xs">
                                <?php foreach($order->items as $item): ?>
                                    <p>• <?php echo $item->menu ? $item->menu->nama : 'Menu dihapus'; ?> (x<?php echo $item->jumlah; ?>)</p>
                                <?php endforeach; ?>
                            </td>
                            <td class="p-4 font-bold text-red-600">Rp<?php echo number_format($order->total_harga, 0, ',', '.'); ?></td>
                            <td class="p-4">
                                <form action="<?php echo route('admin.updateStatus', $order->id); ?>" method="POST" class="flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <select name="status" class="border rounded px-2 py-1 text-xs">
                                        <option value="Menunggu Pembayaran" <?php echo $order->status == 'Menunggu Pembayaran' ? 'selected' : ''; ?>>Menunggu</option>
                                        <option value="Diproses" <?php echo $order->status == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                        <option value="Selesai" <?php echo $order->status == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                        <option value="Dibatalkan" <?php echo $order->status == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">Ubah</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>