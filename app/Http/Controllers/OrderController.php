<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Menampilkan Semua Riwayat Pesanan User / Auto-Redirect jika Admin
    public function index(Request $request)
    {
        // Role-Based Redirect: Jika user yang login adalah Admin, arahkan langsung ke Admin Dashboard
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $query = Order::with('ticketCategory.event')
                    ->where('user_id', Auth::id());

        // Logika Filter Tab Dashboard User (Mendatang / Selesai)
        if ($request->filter === 'upcoming') {
            $query->whereHas('ticketCategory.event', function($q) {
                $q->where('event_date', '>=', now());
            });
        } elseif ($request->filter === 'history') {
            $query->whereHas('ticketCategory.event', function($q) {
                $q->where('event_date', '<', now());
            });
        }

        $orders = $query->latest()->get();

        return view('dashboard', compact('orders'));
    }

    // Menampilkan Halaman Form Checkout (Isi NIK & Rincian Pesanan)
    public function create(Request $request)
    {
        $request->validate([
            'ticket_category_id' => 'required|exists:ticket_categories,id',
            'quantity'           => 'required|integer|min:1',
        ]);

        $ticketCategory = TicketCategory::with('event')->findOrFail($request->ticket_category_id);

        if ($ticketCategory->stock < $request->quantity) {
            return back()->with('error', 'Stok tiket tidak mencukupi! Sisa stok: ' . $ticketCategory->stock);
        }

        $quantity = $request->quantity;

        return view('checkout.create', compact('ticketCategory', 'quantity'));
    }

    // Menyimpan Pesanan Tiket Baru, Potong Stok, NIK, dan Metode Pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'ticket_category_id' => 'required|exists:ticket_categories,id',
            'quantity'           => 'required|integer|min:1',
            'customer_name'      => 'required|string|max:255',
            'nik'                => 'required|numeric|digits:16',
            'payment_method'     => 'required|string',
        ], [
            'nik.required'            => 'NIK / No. KTP wajib diisi!',
            'nik.digits'              => 'NIK harus berjumlah 16 digit angka.',
            'nik.numeric'             => 'NIK harus berupa angka.',
            'payment_method.required' => 'Pilih salah satu metode pembayaran!',
        ]);

        return DB::transaction(function () use ($request) {
            // Lock row kategori tiket agar stok akurat saat transaksi bersamaan
            $ticketCategory = TicketCategory::lockForUpdate()->findOrFail($request->ticket_category_id);

            // 1. Cek ketersediaan stok
            if ($ticketCategory->stock < $request->quantity) {
                return back()->with('error', 'Stok tiket tidak mencukupi! Sisa stok: ' . $ticketCategory->stock);
            }

            // 2. Potong stok tiket
            $ticketCategory->decrement('stock', $request->quantity);

            // 3. Hitung total bayar (Termasuk Admin & Pajak 10%)
            $subtotal = $ticketCategory->price * $request->quantity;
            $adminFee = 10000;
            $taxFee = $subtotal * 0.10;
            $totalAmount = $subtotal + $adminFee + $taxFee;

            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            // 4. Simpan transaksi ke database
            $order = Order::create([
                'order_number'       => $orderNumber,
                'user_id'            => Auth::id(),
                'customer_name'      => $request->customer_name,
                'nik'                => $request->nik,
                'ticket_category_id' => $ticketCategory->id,
                'quantity'           => $request->quantity,
                'total_amount'       => $totalAmount,
                'payment_method'     => $request->payment_method,
                'status'             => 'pending',
            ]);

            return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
        });
    }

    // Menampilkan Detail Pesanan / E-Tiket
    public function show($id)
    {
        $order = Order::with('ticketCategory.event')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // Simulasi Konfirmasi Pembayaran
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        
        $order->update([
            'status' => 'paid'
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran berhasil dikonfirmasi! E-Tiket kamu sudah aktif.');
    }
}