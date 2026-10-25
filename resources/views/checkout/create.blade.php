<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Tiket - {{ $ticketCategory->event->title ?? 'Konser' }} - KonserTix</title>
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

    <!-- NAVBAR HEADER -->
    <nav class="bg-gray-900/80 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Batalkan & Kembali -->
                <a href="{{ route('events.show', $ticketCategory->event_id ?? 1) }}" class="text-xs font-semibold text-gray-400 hover:text-white bg-gray-800/80 hover:bg-gray-700 px-3.5 py-2 rounded-xl transition border border-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Batalkan & Kembali</span>
                </a>

                <!-- Logo KonserTix -->
                <a href="/" class="flex items-center space-x-2 text-xl font-extrabold tracking-tight text-white">
                    <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
                    <span>Konser<span class="text-indigo-500">Tix</span></span>
                </a>
            </div>
        </div>
    </nav>

    @php
        $ticketPrice = $ticketCategory->price * $quantity;
        $adminFee = 10000;
        $taxFee = $ticketPrice * 0.10; // Pajak Hiburan 10%
        $grandTotal = $ticketPrice + $adminFee + $taxFee;
    @endphp

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full space-y-6">
        
        <!-- COUNTDOWN TIMER WIDGET -->
        <div class="bg-amber-500/10 border border-amber-500/30 text-amber-300 px-4 py-3 rounded-2xl flex items-center justify-between text-xs sm:text-sm">
            <div class="flex items-center gap-2.5">
                <i class="fa-regular fa-clock text-amber-400 text-base animate-pulse"></i>
                <span>Sisa Waktu Penyelesaian Pembayaran:</span>
            </div>
            <span id="countdown" class="font-mono font-bold text-amber-400 text-sm sm:text-base tracking-wider bg-amber-500/20 px-3 py-1 rounded-xl">14:59</span>
        </div>

        <div class="text-center">
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Formulir Pemesanan Tiket</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Lengkapi data diri dan pilih metode pembayaran untuk menerbitkan e-tiket Anda.</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="bg-gray-900 border border-gray-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
            @csrf
            <input type="hidden" name="ticket_category_id" value="{{ $ticketCategory->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <!-- RINCIAN TIKET & LOKASI KONSER -->
            <div class="bg-gray-950/80 border border-gray-800/80 rounded-2xl p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-800/80 pb-3">
                    <span class="text-[11px] font-bold tracking-wider text-indigo-400 uppercase flex items-center gap-1.5">
                        <i class="fa-solid fa-ticket"></i>
                        <span>Rincian Tiket & Acara</span>
                    </span>
                    <span class="text-xs bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 px-2.5 py-0.5 rounded-full font-bold">
                        {{ $quantity }} Tiket
                    </span>
                </div>

                <div>
                    <h2 class="text-lg sm:text-xl font-extrabold text-white leading-snug">
                        {{ $ticketCategory->event->title ?? 'Nama Konser' }}
                    </h2>
                    <p class="text-xs text-indigo-300 font-semibold mt-1">
                        Kategori: <span class="text-white font-bold">{{ $ticketCategory->name }}</span>
                    </p>
                </div>

                <!-- Tanggal & Lokasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-gray-300 pt-2 border-t border-gray-800/60">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar-check text-indigo-400 w-4"></i>
                        <span>{{ \Carbon\Carbon::parse($ticketCategory->event->event_date)->translatedFormat('d F Y - H:i') }} WIB</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-indigo-400 w-4"></i>
                        <span class="truncate">{{ $ticketCategory->event->location ?? 'Venue Konser' }}</span>
                    </div>
                </div>

                <!-- BREAKDOWN RINCIAN BIAYA -->
                <div class="bg-gray-900/90 border border-gray-800 rounded-xl p-4 space-y-2 text-xs">
                    <div class="flex justify-between text-gray-400">
                        <span>Harga Tiket ({{ $quantity }}x {{ $ticketCategory->name }})</span>
                        <span class="text-white font-medium">Rp {{ number_format($ticketPrice, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>Biaya Layanan / Admin</span>
                        <span class="text-white font-medium">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-400">
                        <span>Pajak Hiburan (10%)</span>
                        <span class="text-white font-medium">Rp {{ number_format($taxFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-800 text-sm font-black text-white">
                        <span>Total Pembayaran:</span>
                        <span class="text-indigo-400 text-lg sm:text-xl">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- DATA PEMEGANG TIKET -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2 border-b border-gray-800 pb-2">
                    <i class="fa-solid fa-id-card text-indigo-400"></i>
                    <span>Data Pemegang Tiket</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Nama Pemegang Tiket (Sesuai KTP/SIM)</label>
                        <input type="text" name="customer_name" value="{{ Auth::user()->name ?? 'Dian' }}" required
                               class="w-full bg-gray-950 border border-gray-800 text-white text-xs rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Email Konfirmasi (Untuk E-Tiket)</label>
                        <input type="email" name="customer_email" value="{{ Auth::user()->email ?? 'dian@gmail.com' }}" required
                               class="w-full bg-gray-950 border border-gray-800 text-white text-xs rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">NIK / No. KTP Pemegang Tiket (Wajib 16 Digit) <span class="text-rose-400">*</span></label>
                        <input type="text" name="nik" maxlength="16" placeholder="Masukkan 16 digit KTP Anda" required
                               class="w-full bg-gray-950 border border-gray-800 text-white text-xs rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 tracking-wider">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Nomor Telepon / WhatsApp <span class="text-rose-400">*</span></label>
                        <input type="tel" name="customer_phone" placeholder="Contoh: 081234567890" value="081234567890" required
                               class="w-full bg-gray-950 border border-gray-800 text-white text-xs rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <!-- METODE PEMBAYARAN (2 Kolom Simetris: QRIS & VA) -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2 border-b border-gray-800 pb-2">
                    <i class="fa-solid fa-wallet text-indigo-400"></i>
                    <span>Pilih Metode Pembayaran <span class="text-rose-400">*</span></span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="paymentMethods">
                    <!-- Opsi QRIS -->
                    <label class="payment-card relative flex flex-col justify-between p-4 rounded-xl border border-indigo-500 bg-indigo-500/10 cursor-pointer transition" data-method="QRIS" onclick="selectPayment('QRIS')">
                        <input type="radio" name="payment_method" value="QRIS" checked class="sr-only">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fa-solid fa-qrcode text-indigo-400 text-lg"></i>
                            <span class="text-[10px] bg-indigo-500 text-white px-2 py-0.5 rounded font-bold">Instan</span>
                        </div>
                        <span class="block text-xs font-bold text-white">QRIS</span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">GoPay, OVO, Dana, ShopeePay</span>
                    </label>

                    <!-- Opsi Virtual Account -->
                    <label class="payment-card relative flex flex-col justify-between p-4 rounded-xl border border-gray-800 bg-gray-950/60 cursor-pointer transition" data-method="VA" onclick="selectPayment('VA')">
                        <input type="radio" name="payment_method" value="Virtual Account" class="sr-only">
                        <div class="flex items-center justify-between mb-2">
                            <i class="fa-solid fa-building-columns text-gray-400 text-lg"></i>
                            <span class="text-[10px] bg-gray-800 text-gray-300 px-2 py-0.5 rounded font-bold">Transfer Bank</span>
                        </div>
                        <span class="block text-xs font-bold text-white">Virtual Account / VA</span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">BCA, Mandiri, BRI, BNI</span>
                    </label>
                </div>

                <!-- Sub-Pilihan Bank VA (Muncul Dinamis) -->
                <div id="vaSubOptions" class="hidden space-y-3 bg-gray-950/80 border border-gray-800 p-4 rounded-2xl transition-all">
                    <label class="block text-xs font-semibold text-gray-300 mb-2">Pilih Bank Virtual Account:</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-800 bg-gray-900 cursor-pointer hover:border-indigo-500 text-xs text-white">
                            <input type="radio" name="payment_method" value="BCA VA" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="font-bold">BCA VA</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-800 bg-gray-900 cursor-pointer hover:border-indigo-500 text-xs text-white">
                            <input type="radio" name="payment_method" value="Mandiri VA" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="font-bold">Mandiri VA</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-800 bg-gray-900 cursor-pointer hover:border-indigo-500 text-xs text-white">
                            <input type="radio" name="payment_method" value="BRI VA" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="font-bold">BRI VA</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-gray-800 bg-gray-900 cursor-pointer hover:border-indigo-500 text-xs text-white">
                            <input type="radio" name="payment_method" value="BNI VA" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="font-bold">BNI VA</span>
                        </label>
                    </div>
                </div>

                <!-- Info Petunjuk Metode Pembayaran Aktif -->
                <div id="paymentInfoBox" class="bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-xs p-3.5 rounded-xl flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-info text-indigo-400 shrink-0 text-sm"></i>
                    <span id="paymentInfoText">Petunjuk pembayaran QRIS akan muncul setelah Anda menekan tombol Lanjutkan ke Pembayaran.</span>
                </div>
            </div>

            <!-- CHECKBOX PERSETUJUAN -->
            <div class="pt-2">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" required class="mt-0.5 w-4 h-4 text-indigo-600 bg-gray-950 border-gray-800 rounded focus:ring-indigo-500">
                    <span class="text-xs text-gray-400 leading-relaxed">
                        Saya menyetujui <a href="#" class="text-indigo-400 hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-indigo-400 hover:underline">Kebijakan Privasi</a> KonserTix.
                    </span>
                </label>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="space-y-3 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm flex items-center justify-center gap-2">
                    <span>Lanjutkan ke Pembayaran</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>

                <div class="text-center text-[11px] text-gray-500 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-lock text-emerald-500"></i>
                    <span>Transaksi Aman & Terenkripsi 256-bit SSL</span>
                </div>
            </div>
        </form>
    </main>

    <footer class="bg-gray-950 border-t border-gray-800 text-gray-500 text-xs py-6 text-center">
        &copy; {{ date('Y') }} KonserTix. All rights reserved.
    </footer>

    <!-- JAVASCRIPT: Countdown Timer & Metode Pembayaran Interaktif -->
    <script>
        // Countdown Timer 15 Menit
        let duration = 15 * 60;
        const countdownElement = document.getElementById('countdown');

        const timer = setInterval(function () {
            let minutes = parseInt(duration / 60, 10);
            let seconds = parseInt(duration % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if (countdownElement) {
                countdownElement.textContent = minutes + ":" + seconds;
            }

            if (--duration < 0) {
                clearInterval(timer);
                if (countdownElement) {
                    countdownElement.textContent = "Waktu Habis";
                }
                alert("Waktu pemesanan tiket Anda telah habis. Silakan ulangi pemesanan.");
                window.location.href = "/";
            }
        }, 1000);

        // Dinamis Petunjuk Pembayaran & Highlight Card
        function selectPayment(type) {
            const cards = document.querySelectorAll('.payment-card');
            const vaSub = document.getElementById('vaSubOptions');
            const infoText = document.getElementById('paymentInfoText');

            cards.forEach(card => {
                if(card.getAttribute('data-method') === type) {
                    card.classList.remove('border-gray-800', 'bg-gray-950/60');
                    card.classList.add('border-indigo-500', 'bg-indigo-500/10');
                } else {
                    card.classList.remove('border-indigo-500', 'bg-indigo-500/10');
                    card.classList.add('border-gray-800', 'bg-gray-950/60');
                }
            });

            if(type === 'VA') {
                vaSub.classList.remove('hidden');
                infoText.textContent = "Nomor Virtual Account bank pilihan Anda akan diberikan pada halaman pembayaran berikutnya.";
                // Set default radio ke BCA VA jika VA dipilih
                document.querySelector('input[name="payment_method"][value="BCA VA"]').checked = true;
            } else {
                vaSub.classList.add('hidden');
                infoText.textContent = "Petunjuk pembayaran QRIS akan muncul setelah Anda menekan tombol Lanjutkan ke Pembayaran.";
            }
        }
    </script>
</body>
</html>