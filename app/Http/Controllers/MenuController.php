<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('tersedia', true)->get();
        return view('welcome', compact('menus'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'metode_pembayaran' => 'required|string',
            'cart' => 'required|string',
        ]);

        $cart = json_decode($request->cart, true);

        if (!$cart || count($cart) === 0) {
            return back()->with('error', 'Keranjang belanja kamu masih kosong.');
        }

        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalHarga,
            'status' => 'Menunggu Pembayaran',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
            ]);
        }

        return redirect()->route('riwayat')->with('success', 'Pesanan kamu berhasil dibuat dengan ID #' . $order->id . '!');
    }

    public function riwayat()
    {
        $orders = Order::with('items.menu')->orderBy('created_at', 'desc')->get();
        return view('riwayat', compact('orders'));
    }

    // --- FITUR LOGIN ADMIN ---

    // Menampilkan Form Login Admin
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('login');
    }

    // Proses Autentikasi Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin')->with('success', 'Selamat datang kembali, Admin!');
        }

        return back()->with('error', 'Email atau Password yang kamu masukkan salah.');
    }

    // Proses Logout Admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kamu berhasil logout.');
    }

    // Dashboard Admin
    public function admin()
    {
        $orders = Order::with('items.menu')->orderBy('created_at', 'desc')->get();
        $menus = Menu::all();
        return view('admin', compact('orders', 'menus'));
    }

    // Ubah Status Pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan #' . $id . ' berhasil diperbarui!');
    }
}