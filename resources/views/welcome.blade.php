<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonserTix - Platform Tiket Konser Musik Terbesar</title>
    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0b0f19;
            color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">

    <!-- 1. NAVBAR LENGKAP -->
    <nav class="bg-gray-900/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3">
                    <span class="text-indigo-500 text-2xl"><i class="fa-solid fa-music"></i></span>
                    <span class="text-xl font-extrabold tracking-tight text-white">Konser<span class="text-indigo-500">Tix</span></span>
                </a>

                <!-- Nav Menu Standar (Aktif Berfungsi) -->
                <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="/" class="text-indigo-400 hover:text-white transition">Jadwal Konser</a>
                    <a href="#katalog" class="text-gray-300 hover:text-white transition">Kategori</a>
                    <a href="#footer-section" class="text-gray-300 hover:text-white transition">Tentang Kami</a>
                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-gray-300 hover:text-white transition">Cek Pesanan</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="/dashboard" class="text-sm font-medium text-gray-300 hover:text-white px-3 py-2">Dashboard</a>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-sm px-4 py-2 rounded-lg transition">Keluar</button>
                        </form>
                    @else
                        <a href="/login" class="text-sm font-medium text-gray-300 hover:text-white px-3 py-2">Masuk</a>
                        <a href="/register" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-lg shadow-indigo-600/30">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <!-- 2. HERO BANNER HEADER -->
        <div class="relative bg-gradient-to-r from-gray-950 via-gray-900 to-indigo-950 border-b border-gray-800 py-12 md:py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
                <span class="bg-indigo-500/20 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-indigo-500/30 inline-block">
                    🔥 PLATFORM TIKET RESMI
                </span>
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
                    Rasakan Sensasi Konser <br class="hidden sm:inline">Paling Spektakuler
                </h1>
                <p class="text-gray-400 text-sm md:text-base max-w-xl mx-auto">
                    Dapatkan tiket konser musisi favoritmu secara aman, cepat, dan tanpa antre. Jaminan 100% Asli.
                </p>

                <!-- Search Bar -->
                <form action="/" method="GET" class="mt-6 relative max-w-xl mx-auto flex items-center">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari konser, musisi, atau lokasi..." 
                           class="w-full bg-gray-800/90 border border-gray-700 text-white placeholder-gray-400 pl-11 pr-24 py-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                    <button type="submit" class="absolute right-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">
                        Cari
                    </button>
                </form>

                <!-- Filter Category Chips -->
                <div class="flex flex-wrap items-center justify-center gap-2 mt-4 text-xs">
                    <a href="/" class="px-4 py-1.5 rounded-full border {{ !request('category') ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-gray-800 text-gray-300 border-gray-700 hover:border-gray-500' }}">Semua</a>
                    <a href="/?category=national" class="px-4 py-1.5 rounded-full border {{ request('category') == 'national' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-gray-800 text-gray-300 border-gray-700 hover:border-gray-500' }}">🇮🇩 ID Nasional</a>
                    <a href="/?category=international" class="px-4 py-1.5 rounded-full border {{ request('category') == 'international' ? 'bg-indigo-600 text-white border-indigo-500' : 'bg-gray-800 text-gray-300 border-gray-700 hover:border-gray-500' }}">🌍 Internasional</a>
                </div>
            </div>
        </div>

        <!-- 3. KATALOG KONSER -->
        <div id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-white tracking-tight">Jadwal & Tiket Konser Terbaru</h2>
                    <p class="text-gray-400 text-xs mt-1">Pilih dan amankan tiketmu sebelum kehabisan!</p>
                </div>
            </div>

            @if($events->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-6">
                @foreach($events as $event)
                    @php
                        $minPrice = $event->ticketCategories->min('price');
                        $totalStock = $event->ticketCategories->sum('stock');
                        $artistParts = explode(' - ', $event->title);
                        $artistName = $artistParts[0] ?? $event->title;
                        
                        // Membaca kategori langsung dari kolom database event
                        $eventCategory = strtoupper($event->category ?? 'national');
                    @endphp
                    
                    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden hover:border-indigo-500/50 transition duration-300 flex flex-col justify-between group shadow-xl">
                        <div>
                            <!-- Poster Image 16:9 & Badges dengan Fallback Aman -->
                            <div class="relative aspect-video w-full overflow-hidden bg-gray-950">
                                <img src="{{ $event->banner_image ?: 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1000' }}" 
                                     alt="{{ $event->title }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1000'"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-90"></div>
                                
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-gray-950/80 text-gray-200 border border-gray-700 text-[10px] font-bold px-2.5 py-1 rounded-md backdrop-blur-md uppercase tracking-wider">
                                        {{ $eventCategory }}
                                    </span>
                                </div>

                                <!-- Status Badge Tiket -->
                                <div class="absolute top-3 right-3">
                                    @if($totalStock > 50)
                                        <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-md">
                                            ● Tersedia
                                        </span>
                                    @elseif($totalStock > 0)
                                        <span class="bg-amber-500/20 text-amber-400 border border-amber-500/40 text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-md">
                                            ⚠️ Hampir Habis
                                        </span>
                                    @else
                                        <span class="bg-rose-500/20 text-rose-400 border border-rose-500/40 text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-md">
                                            ⛔ Sold Out
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Info -->
                            <div class="p-5 space-y-3">
                                <h3 class="text-base font-extrabold text-white group-hover:text-indigo-400 transition leading-snug line-clamp-2">
                                    {{ $event->title }}
                                </h3>

                                <div class="space-y-1.5 text-xs text-gray-300">
                                    <!-- Nama Artis/Guest Star -->
                                    <div class="flex items-center space-x-2 text-indigo-400 font-semibold">
                                        <i class="fa-solid fa-microphone text-xs w-4"></i>
                                        <span>{{ $artistName }}</span>
                                    </div>
                                    <!-- Tanggal -->
                                    <div class="flex items-center space-x-2 text-gray-400">
                                        <i class="fa-regular fa-calendar text-xs w-4 text-gray-500"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y - H:i') }} WIB</span>
                                    </div>
                                    <!-- Lokasi Konser -->
                                    <div class="flex items-center space-x-2 text-gray-400">
                                        <i class="fa-solid fa-location-dot text-xs w-4 text-gray-500"></i>
                                        <span class="line-clamp-1">{{ $event->location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 pb-5 pt-3 flex items-center justify-between border-t border-gray-800/80 mt-2 bg-gray-900/50">
                            <div>
                                <span class="text-[10px] uppercase font-semibold text-gray-400 block tracking-wider">Mulai Dari</span>
                                <span class="text-base font-extrabold text-white">
                                    Rp {{ number_format($minPrice ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="/events/{{ $event->id }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-md shadow-indigo-600/30 flex items-center space-x-1.5">
                                <span>Detail Tiket</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if(method_exists($events, 'links'))
            <div class="mt-8">
                {{ $events->links() }}
            </div>
            @endif

            @else
            <!-- State Kosong -->
            <div class="text-center py-16 bg-gray-900/50 rounded-2xl border border-gray-800 my-8">
                <i class="fa-solid fa-ticket-simple text-4xl text-gray-600 mb-3"></i>
                <p class="text-gray-400 text-base font-medium">Konser yang kamu cari tidak ditemukan.</p>
                <a href="/" class="mt-4 inline-block text-xs text-indigo-400 hover:text-indigo-300 underline">Tampilkan semua konser</a>
            </div>
            @endif
        </div>
    </main>

    <!-- 4. FOOTER LENGKAP -->
    <footer id="footer-section" class="bg-gray-950 border-t border-gray-800 mt-16 text-gray-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-indigo-500 text-xl"><i class="fa-solid fa-music"></i></span>
                        <span class="text-lg font-extrabold text-white">Konser<span class="text-indigo-500">Tix</span></span>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Platform penyedia tiket konser musik resmi terpercaya di Indonesia. Dapatkan pengalaman transaksi cepat, aman, dan mudah.
                    </p>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Navigasi</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="/" class="hover:text-white transition">Jadwal Konser</a></li>
                        <li><a href="#katalog" class="hover:text-white transition">Kategori Konser</a></li>
                        <li><a href="#" class="hover:text-white transition">Cara Pembelian</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Dukungan</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="hover:text-white transition">Pusat Bantuan / FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Hubungi Kami</h4>
                    <div class="flex space-x-4 text-base text-gray-400 mb-3">
                        <a href="#" class="hover:text-indigo-400 transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="hover:text-indigo-400 transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="hover:text-indigo-400 transition"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="hover:text-indigo-400 transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                    <p class="text-xs text-gray-400">Email: support@konsertix.id</p>
                </div>
            </div>
            <div class="border-t border-gray-900 pt-6 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} KonserTix. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>