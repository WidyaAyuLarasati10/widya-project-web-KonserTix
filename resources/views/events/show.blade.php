<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - KonserTix</title>
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

    <!-- NAVBAR -->
    <nav class="bg-gray-900/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo Brand -->
                <a href="/" class="flex items-center space-x-3">
                    <span class="text-indigo-500 text-2xl"><i class="fa-solid fa-music"></i></span>
                    <span class="text-xl font-extrabold tracking-tight text-white">Konser<span class="text-indigo-500">Tix</span></span>
                </a>

                <a href="/" class="text-xs font-semibold text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 px-3.5 py-2 rounded-xl transition border border-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Katalog</span>
                </a>
            </div>
        </div>
    </nav>

    @php
        $artistParts = explode(' - ', $event->title);
        $artistName = $artistParts[0] ?? $event->title;
        
        // Palette warna khusus untuk sinkronisasi Kategori & Seat Map
        $colorPalette = [
            ['bg' => 'bg-purple-900/40', 'border' => 'border-purple-500/50', 'text' => 'text-purple-300', 'badge' => 'bg-purple-500/10 border-purple-500/30 text-purple-400'],
            ['bg' => 'bg-blue-900/40', 'border' => 'border-blue-500/50', 'text' => 'text-blue-300', 'badge' => 'bg-blue-500/10 border-blue-500/30 text-blue-400'],
            ['bg' => 'bg-emerald-900/40', 'border' => 'border-emerald-500/50', 'text' => 'text-emerald-300', 'badge' => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400'],
            ['bg' => 'bg-amber-900/40', 'border' => 'border-amber-500/50', 'text' => 'text-amber-300', 'badge' => 'bg-amber-500/10 border-amber-500/30 text-amber-400'],
            ['bg' => 'bg-rose-900/40', 'border' => 'border-rose-500/50', 'text' => 'text-rose-300', 'badge' => 'bg-rose-500/10 border-rose-500/30 text-rose-400'],
        ];
    @endphp

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        <!-- BANNER & HEADER INFO KONSER -->
        <div class="relative bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-2xl mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
                
                <!-- Poster Banner Image -->
                <div class="lg:col-span-5 relative aspect-video lg:aspect-square w-full bg-gray-950 overflow-hidden">
                    <img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent lg:hidden"></div>
                </div>

                <!-- Detail Header Text -->
                <div class="lg:col-span-7 p-6 sm:p-10 space-y-4">
                    <span class="bg-indigo-500/20 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-indigo-500/30 inline-block">
                        🔥 KONSER RESMI 2026/2027
                    </span>
                    
                    <h1 class="text-2xl sm:text-4xl font-black text-white leading-tight">
                        {{ $event->title }}
                    </h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-gray-300 pt-2 border-t border-gray-800/80">
                        <div class="flex items-center space-x-2.5 text-indigo-400 font-bold">
                            <i class="fa-solid fa-microphone text-sm w-5"></i>
                            <span>{{ $artistName }}</span>
                        </div>
                        <div class="flex items-center space-x-2.5 text-gray-300">
                            <i class="fa-regular fa-calendar-check text-indigo-400 text-sm w-5"></i>
                            <span>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y - H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center space-x-2.5 text-gray-300 sm:col-span-2">
                            <i class="fa-solid fa-location-dot text-indigo-400 text-sm w-5"></i>
                            <span class="font-medium text-white">{{ $event->location }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN LAYOUT: KATEGORI TIKET & DESKRIPSI -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Kiri: Pilihan Tiket & Kuantitas -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-gray-900 border border-gray-800 p-6 rounded-2xl shadow-xl space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-800 pb-3">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-ticket text-indigo-500"></i>
                            <span>Pilih Kategori Tiket</span>
                        </h2>
                        <span class="text-xs text-gray-400">*Maks. 5 tiket per transaksi</span>
                    </div>

                    @if($event->ticketCategories && $event->ticketCategories->count() > 0)
                        <div class="space-y-4">
                            @foreach($event->ticketCategories as $index => $category)
                                @php
                                    $isSeating = str_contains(strtolower($category->name), 'seating');
                                    $theme = $colorPalette[$index % count($colorPalette)];
                                @endphp
                                <div class="bg-gray-950/60 border border-gray-800 hover:border-indigo-500/50 p-5 rounded-xl transition space-y-4">
                                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                        <div class="space-y-1.5 flex-1">
                                            <h3 class="font-extrabold text-white text-base sm:text-lg leading-snug">{{ $category->name }}</h3>
                                            
                                            <!-- Badge Tempat Duduk dengan Warna Sinkron -->
                                            <div class="flex flex-wrap items-center gap-2 pt-1">
                                                <span class="text-[10px] font-bold px-2.5 py-0.5 rounded border {{ $theme['badge'] }}">
                                                    <i class="fa-solid {{ $isSeating ? 'fa-chair' : 'fa-person-walking' }} mr-1"></i>
                                                    {{ $isSeating ? 'Numbered Seating' : 'Free Standing' }}
                                                </span>
                                                <span class="text-xs text-gray-400">Sisa Stok: <span class="text-amber-400 font-semibold">{{ $category->stock }} tiket</span></span>
                                            </div>
                                        </div>

                                        <!-- Menghindari Teks Harga Terpotong -->
                                        <div class="text-left md:text-right shrink-0">
                                            <p class="text-[11px] text-gray-400">Harga per tiket</p>
                                            <p class="text-lg sm:text-xl font-black text-indigo-400 whitespace-nowrap">
                                                Rp {{ number_format($category->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Form Checkout dengan Stepper & Subtotal Otomatis -->
                                    <form action="{{ route('checkout.create') }}" method="GET" class="pt-3 border-t border-gray-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        <input type="hidden" name="ticket_category_id" value="{{ $category->id }}">
                                        
                                        <!-- Quantity Stepper Buttons -->
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center space-x-1 bg-gray-900 border border-gray-700 rounded-xl p-1">
                                                <button type="button" onclick="decrementQty({{ $category->id }}, {{ $category->price }})" class="w-8 h-8 rounded-lg bg-gray-800 hover:bg-gray-700 text-white font-bold flex items-center justify-center transition">-</button>
                                                <input type="number" id="qty-{{ $category->id }}" name="quantity" value="1" min="1" max="{{ min($category->stock, 5) }}" readonly class="w-10 text-center bg-transparent text-white font-bold text-sm focus:outline-none">
                                                <button type="button" onclick="incrementQty({{ $category->id }}, {{ min($category->stock, 5) }}, {{ $category->price }})" class="w-8 h-8 rounded-lg bg-gray-800 hover:bg-gray-700 text-white font-bold flex items-center justify-center transition">+</button>
                                            </div>

                                            <!-- Teks Subtotal Otomatis Real-time -->
                                            <div class="text-xs">
                                                <span class="text-gray-400 block">Total:</span>
                                                <span id="subtotal-{{ $category->id }}" class="font-bold text-white text-sm whitespace-nowrap">Rp {{ number_format($category->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2 min-w-[120px]">
                                            <span>Beli Tiket</span>
                                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-sm">Belum ada kategori tiket tersedia untuk konser ini.</p>
                    @endif
                </div>

                <!-- Deskripsi Acara -->
                <div class="bg-gray-900 border border-gray-800 p-6 rounded-2xl shadow-xl space-y-3">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-indigo-400"></i>
                        <span>Deskripsi Acara</span>
                    </h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        {{ $event->description }}
                    </p>
                </div>
            </div>

            <!-- Kanan: Vector Seat Map Dinamis 100% Sesuai Kategori & Syarat Ketentuan -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-gray-900 border border-gray-800 p-6 rounded-2xl shadow-xl space-y-4">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-map text-indigo-400"></i>
                        <span>Denah Panggung / Seat Map</span>
                    </h3>
                    
                    <div class="rounded-2xl overflow-hidden bg-gray-950 border border-gray-800 p-4 space-y-4 text-center">
                        <!-- Stage Box -->
                        <div class="w-full bg-indigo-600/30 border-2 border-indigo-500 text-indigo-300 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-indigo-500/20">
                            🎭 UTAMA - STAGE / PANGGUNG
                        </div>

                        <!-- Grid Seat Map Dinamis 100% Mengikuti Jumlah & Nama Kategori Database -->
                        <div class="space-y-2 text-[11px] font-bold">
                            @foreach($event->ticketCategories as $index => $cat)
                                @php
                                    $theme = $colorPalette[$index % count($colorPalette)];
                                @endphp
                                <div class="{{ $theme['bg'] }} border {{ $theme['border'] }} {{ $theme['text'] }} py-3 rounded-lg transition duration-200 hover:scale-[1.01]">
                                    {{ $cat->name }}
                                </div>
                            @endforeach
                        </div>

                        <p class="text-[11px] text-gray-400 italic pt-1">
                            *Setiap warna menunjukkan zona panggung dan penempatan tiket pilihanmu.
                        </p>
                    </div>
                </div>

                <!-- Syarat & Ketentuan -->
                <div class="bg-gray-900 border border-gray-800 p-6 rounded-2xl shadow-xl space-y-3">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-indigo-400"></i>
                        <span>Syarat & Ketentuan</span>
                    </h3>
                    <ul class="text-xs text-gray-400 space-y-2 list-disc pl-4 leading-relaxed">
                        <li>E-tiket wajib ditukarkan dengan wristband pada H-1 atau hari H di lokasi venue.</li>
                        <li>Wajib membawa kartu identitas asli (KTP/SIM/Paspor) sesuai nama pemesan.</li>
                        <li>Penonton di bawah umur 12 tahun wajib didampingi orang tua / wali.</li>
                        <li>Tiket yang sudah dibeli tidak dapat ditukar atau dikembalikan.</li>
                    </ul>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-950 border-t border-gray-800 mt-16 text-gray-400 text-xs py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-music text-indigo-500 text-base"></i>
                <span class="font-bold text-white">KonserTix</span>
                <span>&copy; {{ date('Y') }} All rights reserved.</span>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

    <!-- Script Counter Quantity Stepper & Automatic Subtotal -->
    <script>
        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        function incrementQty(id, maxStock, price) {
            const input = document.getElementById('qty-' + id);
            const subtotalText = document.getElementById('subtotal-' + id);
            let current = parseInt(input.value) || 1;
            if (current < maxStock) {
                current++;
                input.value = current;
                subtotalText.innerText = formatRupiah(current * price);
            }
        }

        function decrementQty(id, price) {
            const input = document.getElementById('qty-' + id);
            const subtotalText = document.getElementById('subtotal-' + id);
            let current = parseInt(input.value) || 1;
            if (current > 1) {
                current--;
                input.value = current;
                subtotalText.innerText = formatRupiah(current * price);
            }
        }
    </script>
</body>
</html>