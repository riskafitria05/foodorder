<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrder - Pesan Makanan Lezat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 relative">

    <!-- Header / Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-500 flex items-center gap-2">
                <i class="fa-solid fa-utensils"></i> FoodOrder
            </h1>
            <nav class="flex gap-6 font-semibold items-center">
                <a href="#menu" class="hover:text-red-500">Menu</a>
                <a href="<?php echo route('riwayat'); ?>" class="hover:text-red-500">Riwayat</a>
                
                <?php if (\Illuminate\Support\Facades\Auth::check()): ?>
                    <a href="<?php echo route('admin'); ?>" class="text-red-600 font-bold hover:underline">Dashboard Admin</a>
                <?php else: ?>
                    <a href="<?php echo route('login'); ?>" class="bg-gray-800 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-gray-900 transition flex items-center gap-1">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Admin
                    </a>
                <?php endif; ?>

                <a href="#keranjang-section" class="hover:text-red-500 flex items-center gap-1">
                    <i class="fa-solid fa-cart-shopping"></i> Keranjang
                    <span id="cart-count-nav" class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">0</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Notifikasi Sukses / Error -->
    <?php if (session('success')): ?>
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex justify-between items-center">
                <span><?php echo session('success'); ?></span>
                <script>localStorage.removeItem('foodorder_cart');</script>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session('error')): ?>
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <?php echo session('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Hero Section -->
    <section class="bg-red-500 text-white py-12 px-4 text-center mt-2">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-2">Pesan Makanan Favoritmu dengan Mudah</h2>
        <p class="text-red-100 text-lg">Makanan hangat dan lezat langsung diantar ke tempatmu.</p>
    </section>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8 space-y-12">
        
        <!-- Daftar Menu -->
        <section id="menu">
            <div class="flex justify-between items-center mb-6 border-b-2 border-red-500 pb-2">
                <h3 class="text-2xl font-bold">Daftar Menu</h3>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($menus as$menu): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 flex flex-col justify-between hover:shadow-lg transition">
                        
                        <!-- Area Klik Detail -->
                        <div class="cursor-pointer btn-detail-trigger" 
                             data-id="<?php echo $menu->id; ?>"
                             data-nama="<?php echo htmlspecialchars($menu->nama, ENT_QUOTES); ?>"
                             data-deskripsi="<?php echo htmlspecialchars($menu->deskripsi, ENT_QUOTES); ?>"
                             data-harga="<?php echo $menu->harga; ?>"
                             data-gambar="<?php echo $menu->gambar; ?>"
                             data-kategori="<?php echo htmlspecialchars($menu->kategori, ENT_QUOTES); ?>">
                            
                            <img src="<?php echo $menu->gambar; ?>" alt="<?php echo $menu->nama; ?>" class="w-full h-48 object-cover hover:opacity-90 transition">
                            <div class="p-4">
                                <span class="text-xs bg-red-100 text-red-600 font-semibold px-2.5 py-1 rounded-full"><?php echo $menu->kategori; ?></span>
                                <h4 class="text-lg font-bold mt-2 text-gray-900 hover:text-red-500 transition"><?php echo $menu->nama; ?></h4>
                                <p class="text-gray-500 text-sm mt-1 line-clamp-2"><?php echo $menu->deskripsi; ?></p>
                            </div>
                        </div>

                        <div class="p-4 pt-0 flex justify-between items-center">
                            <span class="text-base font-bold text-red-600">Rp<?php echo number_format($menu->harga, 0, ',', '.'); ?></span>
                            <div class="flex gap-2">
                                <button type="button" class="btn-detail-trigger bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-sm font-semibold transition"
                                        data-id="<?php echo $menu->id; ?>"
                                        data-nama="<?php echo htmlspecialchars($menu->nama, ENT_QUOTES); ?>"
                                        data-deskripsi="<?php echo htmlspecialchars($menu->deskripsi, ENT_QUOTES); ?>"
                                        data-harga="<?php echo $menu->harga; ?>"
                                        data-gambar="<?php echo $menu->gambar; ?>"
                                        data-kategori="<?php echo htmlspecialchars($menu->kategori, ENT_QUOTES); ?>">
                                    Detail
                                </button>
                                <button type="button" onclick="tambahKeKeranjang(<?php echo $menu->id; ?>, '<?php echo htmlspecialchars($menu->nama, ENT_QUOTES); ?>', <?php echo$menu->harga; ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition">
                                    + Tambah
                                </button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Bagian Keranjang Belanja -->
        <section id="keranjang-section" class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-xl font-bold mb-4 flex items-center justify-between border-b pb-3">
                <span class="flex items-center gap-2"><i class="fa-solid fa-basket-shopping text-red-500"></i> Keranjang Belanja Saya</span>
                <span id="cart-count-badge" class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-bold">0 Item</span>
            </h3>

            <div id="cart-items" class="space-y-3 max-h-80 overflow-y-auto pr-1">
                <p id="empty-cart-text" class="text-gray-400 text-sm text-center py-6">Keranjang masih kosong. Silakan pilih menu di atas!</p>
            </div>

            <div class="border-t mt-6 pt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-lg font-bold">
                    <span>Total Pembayaran: </span>
                    <span id="cart-total" class="text-2xl text-red-600 ml-2">Rp0</span>
                </div>
                <button type="button" onclick="bukaModalCheckout()" class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-bold px-8 py-3 rounded-lg shadow transition">
                    Lanjut ke Pembayaran
                </button>
            </div>
        </section>

    </main>

    <!-- Tombol Floating Keranjang -->
    <a href="#keranjang-section" class="fixed bottom-6 right-6 bg-red-500 hover:bg-red-600 text-white p-4 rounded-full shadow-2xl z-40 flex items-center gap-2 font-bold transition transform hover:scale-105">
        <i class="fa-solid fa-cart-shopping text-xl"></i>
        <span id="cart-count-floating" class="bg-white text-red-600 text-xs px-2 py-0.5 rounded-full font-extrabold">0</span>
    </a>

    <!-- Modal Detail Menu -->
    <div id="detail-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden relative">
            <button type="button" onclick="tutupDetailMenu()" class="absolute top-3 right-3 bg-white text-gray-600 hover:text-black font-bold text-xl rounded-full w-8 h-8 flex items-center justify-center shadow z-10">&times;</button>
            <img id="detail-gambar" src="" alt="" class="w-full h-64 object-cover">
            <div class="p-6">
                <span id="detail-kategori" class="text-xs bg-red-100 text-red-600 font-semibold px-2.5 py-1 rounded-full"></span>
                <h3 id="detail-nama" class="text-2xl font-bold mt-2 text-gray-900"></h3>
                <p id="detail-deskripsi" class="text-gray-600 text-sm mt-3 leading-relaxed"></p>
                <div class="mt-6 flex justify-between items-center border-t pt-4">
                    <span id="detail-harga" class="text-xl font-bold text-red-600"></span>
                    <button type="button" id="detail-btn-tambah" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg font-bold shadow transition">
                        + Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Pembayaran -->
    <div id="checkout-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 relative">
            <button type="button" onclick="tutupModalCheckout()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
            <h3 class="text-xl font-bold mb-4 border-b pb-2 text-gray-800">Formulir Pemesanan & Pembayaran</h3>
            
            <form action="<?php echo route('checkout'); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="cart" id="cart-input">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="nomor_telepon" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Pengiriman</label>
                        <textarea name="alamat" required rows="2" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Metode Pembayaran</label>
                        <select name="metode_pembayaran" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
                            <option value="Cash on Delivery (COD)">Bayar di Tempat (COD)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 rounded-lg shadow transition">
                        Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let keranjang = JSON.parse(localStorage.getItem('foodorder_cart')) || [];

        function simpanKeranjang() {
            localStorage.setItem('foodorder_cart', JSON.stringify(keranjang));
            updateTampilanKeranjang();
        }

        function tambahKeKeranjang(id, nama, harga) {
            let item = keranjang.find(i => i.id === id);
            if (item) {
                item.jumlah += 1;
            } else {
                keranjang.push({ id, nama, harga, jumlah: 1 });
            }
            simpanKeranjang();
        }

        function ubahJumlah(id, delta) {
            let item = keranjang.find(i => i.id === id);
            if (item) {
                item.jumlah += delta;
                if (item.jumlah <= 0) {
                    keranjang = keranjang.filter(i => i.id !== id);
                }
            }
            simpanKeranjang();
        }

        function updateTampilanKeranjang() {
            const container = document.getElementById('cart-items');
            const totalElement = document.getElementById('cart-total');
            const countNav = document.getElementById('cart-count-nav');
            const countBadge = document.getElementById('cart-count-badge');
            const countFloating = document.getElementById('cart-count-floating');

            if (keranjang.length === 0) {
                container.innerHTML = '<p class="text-gray-400 text-sm text-center py-6">Keranjang masih kosong. Silakan pilih menu di atas!</p>';
                totalElement.innerText = 'Rp0';
                countNav.innerText = '0';
                countBadge.innerText = '0 Item';
                countFloating.innerText = '0';
                return;
            }

            let html = '';
            let total = 0;
            let totalCount = 0;

            keranjang.forEach(item => {
                let subtotal = item.harga * item.jumlah;
                total += subtotal;
                totalCount += item.jumlah;

                html += `
                    <div class="flex justify-between items-center border-b pb-3">
                        <div>
                            <p class="font-semibold text-base">${item.nama}</p>
                            <p class="text-xs text-gray-500">Rp${item.harga.toLocaleString('id-ID')} x ${item.jumlah}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-700">Rp${subtotal.toLocaleString('id-ID')}</span>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="ubahJumlah(${item.id}, -1)" class="w-7 h-7 bg-gray-200 hover:bg-gray-300 rounded font-bold text-sm">-</button>
                                <span class="text-sm font-semibold">${item.jumlah}</span>
                                <button type="button" onclick="ubahJumlah(${item.id}, 1)" class="w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded font-bold text-sm">+</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            totalElement.innerText = 'Rp' + total.toLocaleString('id-ID');
            countNav.innerText = totalCount;
            countBadge.innerText = totalCount + ' Item';
            countFloating.innerText = totalCount;
        }

        // Event Listener Otomatis untuk Detail Menu
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-detail-trigger').forEach(element => {
                element.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const id = parseInt(this.getAttribute('data-id'));
                    const nama = this.getAttribute('data-nama');
                    const deskripsi = this.getAttribute('data-deskripsi');
                    const harga = parseFloat(this.getAttribute('data-harga'));
                    const gambar = this.getAttribute('data-gambar');
                    const kategori = this.getAttribute('data-kategori');

                    document.getElementById('detail-gambar').src = gambar;
                    document.getElementById('detail-nama').innerText = nama;
                    document.getElementById('detail-deskripsi').innerText = deskripsi;
                    document.getElementById('detail-kategori').innerText = kategori;
                    document.getElementById('detail-harga').innerText = 'Rp' + harga.toLocaleString('id-ID');

                    const btnTambah = document.getElementById('detail-btn-tambah');
                    btnTambah.onclick = function() {
                        tambahKeKeranjang(id, nama, harga);
                        tutupDetailMenu();
                    };

                    const modal = document.getElementById('detail-modal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });
        });

        function tutupDetailMenu() {
            const modal = document.getElementById('detail-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function bukaModalCheckout() {
            if (keranjang.length === 0) {
                alert('Keranjang kamu masih kosong!');
                return;
            }
            document.getElementById('cart-input').value = JSON.stringify(keranjang);
            const modal = document.getElementById('checkout-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModalCheckout() {
            const modal = document.getElementById('checkout-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        updateTampilanKeranjang();
    </script>
</body>
</html>