<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tiket Saya - KonserTix</title>
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

    <!-- Header Navigation -->
    <nav class="bg-gray-900/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between h-16 items-center">
            <!-- Brand KonserTix -->
            <a href="/" class="flex items-center space-x-2 text-xl font-extrabold tracking-tight text-white">
                <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
                <span>Konser<span class="text-indigo-500">Tix</span></span>
            </a>
            
            <!-- Right Nav Links & User Status -->
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="/" class="text-xs sm:text-sm font-semibold text-gray-300 hover:text-white transition flex items-center gap-2">
                    <i class="fa-solid fa-compass text-indigo-400"></i>
                    <span>Katalog Konser</span>
                </a>
                <span class="h-4 w-px bg-gray-800 hidden sm:block"></span>
                <span class="text-xs sm:text-sm text-gray-300">
                    Halo, <strong class="text-white">{{ Auth::user()->name ?? 'Dian' }}</strong>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-xs bg-rose-600/80 hover:bg-rose-600 px-3.5 py-1.5 rounded-xl text-white font-semibold transition flex items-center gap-1.5 shadow-lg shadow-rose-600/20">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-10 max-w-5xl mx-auto px-6 flex-grow w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-ticket text-indigo-500"></i>
                    <span>Riwayat Tiket Saya</span>
                </h1>
                <p class="text-sm text-gray-400 mt-1">Daftar semua tiket konser yang sudah kamu pesan.</p>
            </div>

            <!-- Tombol + Cari Konser Lain Hanya Ditampilkan Jika Ada Tiket -->
            @if(!$orders->isEmpty())
                <a href="/" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold px-4 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Cari Konser Lain</span>
                </a>
            @endif
        </div>

        <!-- Tab Filter Status Tiket (Berfungsi Dinamis) -->
        <div class="flex items-center gap-2 border-b border-gray-800 pb-4 mb-6 text-xs sm:text-sm overflow-x-auto">
            <a href="{{ route('dashboard') }}" class="{{ !request('filter') ? 'bg-indigo-600 text-white font-bold border-indigo-500 shadow-md' : 'bg-gray-900 text-gray-400 hover:text-white border-gray-800' }} px-4 py-2 rounded-xl border transition whitespace-nowrap flex items-center gap-2">
                <span>Semua Tiket</span>
            </a>
            
            <a href="{{ route('dashboard', ['filter' => 'upcoming']) }}" class="{{ request('filter') == 'upcoming' ? 'bg-indigo-600 text-white font-bold border-indigo-500 shadow-md' : 'bg-gray-900 text-gray-400 hover:text-white border-gray-800' }} px-4 py-2 rounded-xl border transition whitespace-nowrap">
                Mendatang
            </a>
            
            <a href="{{ route('dashboard', ['filter' => 'history']) }}" class="{{ request('filter') == 'history' ? 'bg-indigo-600 text-white font-bold border-indigo-500 shadow-md' : 'bg-gray-900 text-gray-400 hover:text-white border-gray-800' }} px-4 py-2 rounded-xl border transition whitespace-nowrap">
                Selesai / Riwayat
            </a>
        </div>

        @if($orders->isEmpty())
            <!-- Tampilan Empty State -->
            <div class="bg-gray-800/60 border border-gray-700/80 rounded-2xl p-12 text-center shadow-xl space-y-4 max-w-2xl mx-auto backdrop-blur-xl">
                <div class="w-16 h-16 bg-indigo-500/10 border border-indigo-500/20 rounded-2xl flex items-center justify-center text-indigo-400 text-3xl mx-auto">
                    <i class="fa-solid fa-ticket-simple"></i>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold text-gray-200">Belum Ada Tiket Dipesan</h3>
                    <p class="text-sm text-gray-400 mt-1">Kamu belum membeli tiket konser apa pun untuk kategori ini.</p>
                </div>

                <div class="pt-2">
                    <a href="/" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold px-6 py-3 rounded-xl transition shadow-lg shadow-indigo-600/30">
                        <i class="fa-solid fa-compass"></i>
                        <span>Jelajahi Konser</span>
                    </a>
                </div>
            </div>
        @else
            <!-- Daftar Card Pesanan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($orders as $order)
                    <div class="bg-gray-800/80 border border-gray-700/80 rounded-2xl p-6 shadow-xl flex flex-col justify-between hover:border-indigo-500/50 transition">
                        <div>
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-mono text-gray-400 bg-gray-900/80 px-2.5 py-1 rounded-md border border-gray-700/50">
                                    #{{ $order->order_number ?? 'ORDER-'.$order->id }}
                                </span>
                                @if($order->status === 'paid')
                                    <span class="bg-emerald-900/60 text-emerald-300 border border-emerald-500/30 text-xs px-2.5 py-1 rounded-full font-bold flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle text-[8px] text-emerald-400"></i> Lunas
                                    </span>
                                @else
                                    <span class="bg-amber-900/60 text-amber-300 border border-amber-500/30 text-xs px-2.5 py-1 rounded-full font-bold flex items-center gap-1.5">
                                        <i class="fa-solid fa-clock text-[10px]"></i> Menunggu Bayar
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-xl font-extrabold text-white mb-1 leading-snug">
                                {{ $order->ticketCategory->event->title ?? 'Konser' }}
                            </h2>
                            <p class="text-xs text-indigo-400 font-semibold mb-4 flex items-center gap-1.5">
                                <i class="fa-solid fa-microphone"></i>
                                <span>{{ $order->ticketCategory->event->artist ?? 'Artis Pilihan' }}</span>
                            </p>

                            <div class="bg-gray-900/80 rounded-xl p-3.5 border border-gray-700/60 space-y-2 text-xs mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Kategori:</span>
                                    <span class="font-medium text-gray-200">{{ $order->ticketCategory->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Jumlah:</span>
                                    <span class="font-medium text-gray-200">{{ $order->quantity }} Tiket</span>
                                </div>
                                <div class="flex justify-between pt-2 border-t border-gray-800 text-sm">
                                    <span class="font-bold text-gray-300">Total:</span>
                                    <span class="font-extrabold text-indigo-400">Rp {{ number_format($order->total_price ?? $order->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('orders.show', $order->id) }}" class="w-full text-center bg-gray-700/80 hover:bg-gray-600 text-white font-bold py-2.5 rounded-xl text-xs transition border border-gray-600/80 flex items-center justify-center gap-2">
                            <span>Lihat Detail & {{ $order->status === 'paid' ? 'E-Tiket' : 'Pembayaran' }}</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-800 text-gray-500 text-xs py-6 text-center">
        &copy; {{ date('Y') }} KonserTix. All rights reserved.
    </footer>

</body>
</html>