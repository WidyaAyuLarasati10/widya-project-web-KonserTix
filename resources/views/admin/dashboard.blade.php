<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KonserTix</title>
    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0b0f19;
            color: #f3f4f6;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">

    <!-- NAVBAR ADMIN -->
    <nav class="bg-gray-900/90 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo & Badge Admin -->
                <div class="flex items-center space-x-3">
                    <a href="/" class="flex items-center space-x-2 text-xl font-extrabold tracking-tight text-white">
                        <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
                        <span>Konser<span class="text-indigo-500">Tix</span></span>
                    </a>
                    <span class="bg-indigo-500/20 text-indigo-400 border border-indigo-500/40 text-[10px] font-black uppercase px-2.5 py-0.5 rounded-full tracking-wider">
                        Admin Panel
                    </span>
                </div>

                <!-- Profile / Logout -->
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400 hidden sm:inline">Halo, <strong class="text-white">{{ Auth::user()->name ?? 'Administrator' }}</strong></span>
                    
                    <!-- Tombol Mode User -->
                    <a href="{{ route('dashboard') }}" class="text-xs text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 px-3 py-1.5 rounded-xl border border-gray-700 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Mode User</span>
                    </a>

                    <!-- Tombol Logout (Keluar) -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 bg-rose-500/10 hover:bg-rose-500/20 px-3 py-1.5 rounded-xl border border-rose-500/20 transition flex items-center gap-1.5" title="Keluar Akun">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Flash Alert -->
        @if (session('success'))
            <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-300 p-4 rounded-2xl text-xs sm:text-sm font-medium flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- HEADER TITLE & ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Ringkasan & Kelola Transaksi</h1>
                <p class="text-xs sm:text-sm text-gray-400 mt-1">Pantau statistik penjualan tiket, data pendapatan, dan kelola transaksi pemesanan.</p>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="bg-gray-800 hover:bg-gray-700 text-gray-200 border border-gray-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 shadow">
                    <i class="fa-solid fa-file-arrow-down text-indigo-400"></i>
                    <span>Cetak / Ekspor Laporan</span>
                </button>
            </div>
        </div>

        <!-- 1. STATISTIK KPI CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Pendapatan -->
            <div class="bg-gray-900 border border-gray-800 p-5 rounded-2xl space-y-2 shadow-xl">
                <div class="flex justify-between items-center text-gray-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Pendapatan</span>
                    <i class="fa-solid fa-sack-dollar text-emerald-400 text-lg"></i>
                </div>
                <div class="text-2xl font-black text-white">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </div>
                <p class="text-[11px] text-emerald-400 font-medium">Dari transaksi terkonfirmasi (Paid)</p>
            </div>

            <!-- Total Tiket Terjual -->
            <div class="bg-gray-900 border border-gray-800 p-5 rounded-2xl space-y-2 shadow-xl">
                <div class="flex justify-between items-center text-gray-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Tiket Terjual</span>
                    <i class="fa-solid fa-ticket text-indigo-400 text-lg"></i>
                </div>
                <div class="text-2xl font-black text-white">
                    {{ number_format($totalTicketsSold) }} <span class="text-xs font-normal text-gray-400">Tiket</span>
                </div>
                <p class="text-[11px] text-indigo-400 font-medium">Lunas & siap check-in</p>
            </div>

            <!-- Menunggu Pembayaran -->
            <div class="bg-gray-900 border border-gray-800 p-5 rounded-2xl space-y-2 shadow-xl">
                <div class="flex justify-between items-center text-gray-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Menunggu Bayar</span>
                    <i class="fa-solid fa-clock text-amber-400 text-lg"></i>
                </div>
                <div class="text-2xl font-black text-white">
                    {{ $pendingOrdersCount }} <span class="text-xs font-normal text-gray-400">Transaksi</span>
                </div>
                <p class="text-[11px] text-amber-400 font-medium">Status pending saat ini</p>
            </div>

            <!-- Total Event -->
            <div class="bg-gray-900 border border-gray-800 p-5 rounded-2xl space-y-2 shadow-xl">
                <div class="flex justify-between items-center text-gray-400">
                    <span class="text-xs font-semibold uppercase tracking-wider">Total Event</span>
                    <i class="fa-solid fa-calendar-days text-sky-400 text-lg"></i>
                </div>
                <div class="text-2xl font-black text-white">
                    {{ $totalEventsCount }} <span class="text-xs font-normal text-gray-400">Konser</span>
                </div>
                <p class="text-[11px] text-sky-400 font-medium">Event aktif di platform</p>
            </div>
        </div>

        <!-- 2. TABEL KELOLA TRANSAKSI TERBARU -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-4 shadow-xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-800 pb-4">
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-indigo-400"></i>
                        <span>Daftar Transaksi Terbaru</span>
                    </h2>
                    <p class="text-xs text-gray-400">Kelola dan verifikasi status pembayaran pesanan tiket masuk.</p>
                </div>

                <!-- Search & Filter Form -->
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Order / Nama..." class="bg-gray-950 border border-gray-700 text-white text-xs px-3 py-2 rounded-xl focus:outline-none focus:border-indigo-500 placeholder-gray-500 w-full sm:w-48">
                    
                    <select name="status" class="bg-gray-950 border border-gray-700 text-white text-xs px-3 py-2 rounded-xl focus:outline-none focus:border-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition">
                        Filter
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-300 text-xs px-3 py-2 rounded-xl transition">Reset</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-950 text-gray-400 uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="p-3.5 rounded-l-xl">No. Order</th>
                            <th class="p-3.5">Pemegang Tiket / NIK</th>
                            <th class="p-3.5">Event & Kategori</th>
                            <th class="p-3.5">Metode</th>
                            <th class="p-3.5">Total Bayar</th>
                            <th class="p-3.5">Status</th>
                            <th class="p-3.5 text-right rounded-r-xl">Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/60 text-gray-300">
                        @forelse($latestOrders as $order)
                            <tr class="hover:bg-gray-800/40 transition">
                                <td class="p-3.5 font-mono font-bold text-indigo-400">
                                    #{{ $order->order_number }}
                                </td>
                                <td class="p-3.5">
                                    <strong class="text-white block">{{ $order->user->name ?? '-' }}</strong>
                                    <span class="text-[10px] text-gray-500 font-mono">NIK: {{ $order->nik ?? '-' }}</span>
                                </td>
                                <td class="p-3.5">
                                    <span class="text-white font-semibold block truncate max-w-[180px]">{{ $order->ticketCategory->event->title ?? 'Konser' }}</span>
                                    <span class="text-[10px] text-indigo-300">{{ $order->ticketCategory->name }} ({{ $order->quantity }}x)</span>
                                </td>
                                <td class="p-3.5 font-bold uppercase text-gray-300">
                                    {{ $order->payment_method ?? 'QRIS' }}
                                </td>
                                <td class="p-3.5 font-bold text-white">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="p-3.5">
                                    @if($order->status === 'paid')
                                        <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase">
                                            Lunas (Paid)
                                        </span>
                                    @elseif($order->status === 'pending')
                                        <span class="bg-amber-500/20 text-amber-400 border border-amber-500/30 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-rose-500/20 text-rose-400 border border-rose-500/30 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase">
                                            Batal
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-right space-x-1">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Tombol Detail Pemesan (SUDAH DIPERBAIKI MENGGUNAKAN RELASI USER) -->
                                        <button onclick="alert('DETAIL PEMESANAN #{{ $order->order_number }}\n-----------------------------------\nNama Pemesan: {{ $order->user->name ?? '-' }}\nAkun User: {{ $order->user->name ?? '-' }}\nEmail: {{ $order->user->email ?? '-' }}\nNIK / KTP: {{ $order->nik }}\nMetode Pembayaran: {{ strtoupper($order->payment_method) }}\nStatus: {{ strtoupper($order->status) }}')" class="bg-gray-800 hover:bg-gray-700 text-indigo-300 text-[11px] font-semibold px-2.5 py-1 rounded-lg border border-gray-700 transition" title="Lihat Detail Pemesan">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <!-- Form Ubah Status dengan Konfirmasi JS -->
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status pesanan #{{ $order->order_number }} ini?');">
                                            @csrf
                                            @method('PATCH')
                                            @if($order->status === 'pending')
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-lg transition shadow">
                                                    Konfirmasi Paid
                                                </button>
                                            @else
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-gray-300 text-[11px] font-semibold px-2.5 py-1 rounded-lg border border-gray-700 transition">
                                                    Set Pending
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-500 italic">Tidak ada data transaksi yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Navigasi Paginasi Tabel Transaksi -->
            <div class="pt-4 border-t border-gray-800">
                {{ $latestOrders->links() }}
            </div>
        </div>

        <!-- 3. RINGKASAN STOK EVENT & CRUD EVENT -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-4 shadow-xl">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-gray-800 pb-3">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-indigo-400"></i>
                    <span>Status Stok Tiket & Kelola Event</span>
                </h2>
                <a href="{{ route('admin.events.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition flex items-center gap-1.5 shadow">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span>Tambah Event Baru</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($eventsSummary as $event)
                    <div class="bg-gray-950 border border-gray-800 p-4 rounded-xl space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-white text-sm">{{ $event->title }}</h3>
                                <p class="text-[11px] text-gray-400"><i class="fa-solid fa-location-dot text-indigo-400"></i> {{ $event->location }}</p>
                            </div>
                            <!-- Tombol Edit & Form Hapus Event -->
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-2.5 py-1 rounded-lg text-xs transition inline-flex items-center" title="Edit Event">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event {{ $event->title }} ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 px-2 py-1 rounded-lg text-xs transition border border-rose-500/20" title="Hapus Event">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Daftar Kategori Tiket yang Bersih & Rapi -->
                        <div class="space-y-2 pt-2 border-t border-gray-800">
                            @foreach($event->ticketCategories as $category)
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-300 font-medium">{{ $category->name }}</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-400">Sisa Stok: <strong class="text-indigo-400">{{ $category->stock }}</strong></span>
                                        <span class="text-gray-500">|</span>
                                        <span class="text-gray-400">Harga: <strong class="text-white">Rp {{ number_format($category->price, 0, ',', '.') }}</strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-950 border-t border-gray-800 text-gray-600 text-xs py-4 text-center">
        &copy; {{ date('Y') }} KonserTix Admin Panel. All rights reserved.
    </footer>

</body>
</html>