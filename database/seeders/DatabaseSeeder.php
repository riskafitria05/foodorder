<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin Default untuk Login Dashboard
        User::updateOrCreate(
            ['email' => 'admin@foodorder.com'],
            [
                'name' => 'Admin FoodOrder',
                'password' => Hash::make('admin123'), // Password default: admin123
            ]
        );

        // 2. Data 20 Menu (14 Makanan & 6 Minuman)
        $menus = [
            // --- 14 MAKANAN ---
            [
                'nama' => 'Burger Spesial',
                'deskripsi' => 'Burger daging sapi lezat dengan keju leleh dan sayuran segar.',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'gambar' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Pizza Keju',
                'deskripsi' => 'Pizza renyah dengan toping keju mozarella tebal.',
                'kategori' => 'Makanan',
                'harga' => 45000,
                'gambar' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Kentang Goreng',
                'deskripsi' => 'Kentang goreng gurih dan renyah dengan saus pilihan.',
                'kategori' => 'Makanan',
                'harga' => 15000,
                'gambar' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng dengan bumbu rempah melimpah, telur, dan suwiran ayam.',
                'kategori' => 'Makanan',
                'harga' => 20000,
                'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Mie Goreng Seafood',
                'deskripsi' => 'Mie goreng dengan udang, cumi, dan bakso segar.',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'gambar' => 'https://images.unsplash.com/photo-1612927601601-6638404737ce?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Sate Ayam Madura',
                'deskripsi' => '10 tusuk sate ayam empuk disiram saus kacang gurih dan lontong.',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'gambar' => 'https://images.unsplash.com/photo-1555126634-323283e090fa?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Spaghetti Carbonara',
                'deskripsi' => 'Pasta spaghetti ala Italia dengan saus krim keju dan smoked beef.',
                'kategori' => 'Makanan',
                'harga' => 32000,
                'gambar' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Steak Daging Sapi',
                'deskripsi' => 'Daging sapi grilled lembut disajikan dengan kentang & saus lada hitam.',
                'kategori' => 'Makanan',
                'harga' => 65000,
                'gambar' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Ramen Kuah Kaldu',
                'deskripsi' => 'Mie ramen Jepang dengan kuah kaldu kaya rasa dan telur gurih.',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Ayam Bakar Taliwang',
                'deskripsi' => 'Ayam bakar pedas manis khas Lombok dengan aroma bakaran yang khas.',
                'kategori' => 'Makanan',
                'harga' => 27000,
                'gambar' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Dimsum Ayam Assorted',
                'deskripsi' => 'Dimsum ayam kukus hangat dengan aneka topping dan saus asam pedas.',
                'kategori' => 'Makanan',
                'harga' => 18000,
                'gambar' => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Seblak Komplit',
                'deskripsi' => 'Seblak kuah pedas gurih berisi kerupuk, bakso, sosis, ceker, dan telur.',
                'kategori' => 'Makanan',
                'harga' => 17000,
                'gambar' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Roti Bakar Keju Cokelat',
                'deskripsi' => 'Roti bakar tebal dengan isian keju leleh manis dan meses cokelat.',
                'kategori' => 'Makanan',
                'harga' => 16000,
                'gambar' => 'https://images.unsplash.com/photo-1509722747041-616f39b57569?w=600',
                'tersedia' => true,
            ],

            // --- 6 MINUMAN ---
            [
                'nama' => 'Es Kopi Susu',
                'deskripsi' => 'Kopi espresso dengan campuran susu segar dan gula aren.',
                'kategori' => 'Minuman',
                'harga' => 18000,
                'gambar' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Jus Stroberi',
                'deskripsi' => 'Jus buah stroberi segar dan manis.',
                'kategori' => 'Minuman',
                'harga' => 12000,
                'gambar' => 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Es Teh Manis',
                'deskripsi' => 'Teh melati pilihan yang harum dan menyegarkan.',
                'kategori' => 'Minuman',
                'harga' => 6000,
                'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Matcha Latte',
                'deskripsi' => 'Minuman teh hijau Jepang premium dicampur dengan susu creamy.',
                'kategori' => 'Minuman',
                'harga' => 22000,
                'gambar' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Es Alpukat Kocok',
                'deskripsi' => 'Alpukat matang dikocok dengan susu kental manis cokelat & es serut.',
                'kategori' => 'Minuman',
                'harga' => 20000,
                'gambar' => 'https://images.unsplash.com/photo-1525385133512-2f3bdd039054?w=600',
                'tersedia' => true,
            ],
            [
                'nama' => 'Boba Brown Sugar',
                'deskripsi' => 'Susu segar dengan boba kenyal dan sirup gula aren pilihan.',
                'kategori' => 'Minuman',
                'harga' => 21000,
                'gambar' => 'https://images.unsplash.com/photo-1558857563-b371033873b8?w=600',
                'tersedia' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['nama' => $menu['nama']],
                $menu
            );
        }
    }
}