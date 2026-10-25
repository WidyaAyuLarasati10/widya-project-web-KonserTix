<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan #{{ $order->order_number }} - KonserTix</title>
    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0b0f19;
            color: #f3f4f6;
            font-family: 'Inter', sans-serif;
        }
        @media print {
            @page {
                margin: 8mm;
            }
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
            }
            .print-card {
                border: 2px solid #000 !important;
                background-color: #ffffff !important;
                color: #000000 !important;
                box-shadow: none !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 20px !important;
            }
            .print-text-dark {
                color: #000000 !important;
            }
            .print-header-show {
                display: flex !important;
            }
        }
        .print-header-show {
            display: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between p-4 sm:p-6">

    <!-- Header Navigation (Hidden saat cetak) -->
    <nav class="no-print max-w-3xl w-full mx-auto mb-6 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-gray-400 hover:text-white bg-gray-800/80 hover:bg-gray-700 px-3.5 py-2 rounded-xl transition border border-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Dashboard</span>
        </a>
        
        <!-- Logo KonserTix -->
        <a href="/" class="flex items-center space-x-2 text-xl font-extrabold tracking-tight text-white">
            <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
            <span>Konser<span class="text-indigo-500">Tix</span></span>
        </a>
    </nav>

    <main class="flex-grow max-w-3xl w-full mx-auto my-auto space-y-6">
        <!-- Flash Alert Success -->
        @if (session('success'))
            <div class="no-print bg-emerald-500/20 border border-emerald-500/50 text-emerald-300 p-4 rounded-2xl text-xs sm:text-sm font-medium flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- COUNTDOWN TIMER WIDGET (Hanya tampil jika status masih pending) -->
        @if ($order->status === 'pending')
            <div class="no-print bg-amber-500/10 border border-amber-500/30 text-amber-300 px-4 py-3 rounded-2xl flex items-center justify-between text-xs sm:text-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-regular fa-clock text-amber-400 text-base animate-pulse"></i>
                    <span>Sisa Waktu Pembayaran Berakhir:</span>
                </div>
                <span id="countdown" class="font-mono font-bold text-amber-400 text-sm sm:text-base tracking-wider bg-amber-500/20 px-3 py-1 rounded-xl">14:59</span>
            </div>
        @endif

        <!-- Kartu Utama E-Tiket -->
        <div class="print-card bg-gray-800 rounded-2xl border border-gray-700 p-6 sm:p-8 shadow-2xl relative overflow-hidden space-y-6">
            
            <!-- Pengepala Resmi Khusus Cetakan (Official E-Ticket Header) -->
            <div class="print-header-show justify-between items-center border-b-2 border-black pb-4 mb-2">
                <div class="flex items-center space-x-2">
                    <span class="text-black font-black text-xl"><i class="fa-solid fa-music"></i> Konser<span class="text-indigo-600">Tix</span></span>
                </div>
                <div class="text-right">
                    <span class="text-[11px] font-black uppercase tracking-widest border-2 border-black px-2.5 py-1">OFFICIAL E-TICKET</span>
                </div>
            </div>

            <!-- Badge Status & Header Nomor Order -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-700 pb-6">
                <div>
                    <span class="text-xs text-gray-400 uppercase tracking-widest font-semibold block print-text-dark">Nomor Pemesanan</span>
                    <span class="text-xl font-mono font-bold text-indigo-400 print-text-dark">#{{ $order->order_number }}</span>
                </div>
                <div>
                    @if ($order->status === 'paid')
                        <span class="no-print bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 text-xs px-3.5 py-1.5 rounded-full font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check"></i> E-Tiket Aktif (Paid)
                        </span>
                        <span class="print-header-show text-xs font-bold uppercase border border-black px-3 py-1 rounded">
                            STATUS: E-TIKET AKTIF (PAID)
                        </span>
                    @else
                        <span class="bg-amber-500/20 border border-amber-500/40 text-amber-400 text-xs px-3.5 py-1.5 rounded-full font-bold uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-clock"></i> Menunggu Pembayaran
                        </span>
                    @endif
                </div>
            </div>

            <!-- Detail Event & Konser -->
            <div class="space-y-4 pb-6 border-b border-gray-700">
                <h1 class="text-2xl font-black text-white leading-snug print-text-dark">
                    {{ $order->ticketCategory->event->title }}
                </h1>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">Kategori Tiket</span>
                        <strong class="text-gray-200 print-text-dark text-base">{{ $order->ticketCategory->name }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">Jumlah Tiket</span>
                        <strong class="text-gray-200 print-text-dark text-base">{{ $order->quantity }} Tiket</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">Nama Pemegang Tiket</span>
                        <strong class="text-gray-200 print-text-dark text-sm">{{ $order->customer_name ?? Auth::user()->name }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">NIK Pemegang Tiket</span>
                        <strong class="text-gray-200 font-mono print-text-dark">{{ $order->nik ?? '-' }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">Metode Pembayaran</span>
                        <strong class="text-indigo-400 font-bold print-text-dark uppercase">{{ $order->payment_method ?? 'QRIS' }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-xs print-text-dark">Total Pembayaran</span>
                        <strong class="text-indigo-400 text-lg font-bold print-text-dark">Rp {{ number_format($order->total_price ?? $order->total_amount, 0, ',', '.') }}</strong>
                    </div>
                    <div class="sm:col-span-2 pt-2 border-t border-gray-700/60 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-gray-300">
                        <div class="flex items-center gap-2 print-text-dark">
                            <i class="fa-regular fa-calendar-check text-indigo-400"></i>
                            <span>{{ \Carbon\Carbon::parse($order->ticketCategory->event->event_date)->translatedFormat('d F Y - H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center gap-2 print-text-dark">
                            <i class="fa-solid fa-location-dot text-indigo-400"></i>
                            <span>{{ $order->ticketCategory->event->location }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AREA INSTRUKSI PEMBAYARAN / VA ATAU QRIS / E-TIKET AKTIF -->
            <div class="pt-2 text-center">
                @if ($order->status === 'pending')
                    @php
                        $isVa = str_contains(strtoupper($order->payment_method), 'VA') || str_contains(strtoupper($order->payment_method), 'VIRTUAL ACCOUNT');
                        $vaPrefix = '88012';
                        $vaNumber = $vaPrefix . preg_replace('/[^0-9]/', '', $order->order_number);
                        
                        $bankName = str_replace(' VA', '', strtoupper($order->payment_method));
                        if($bankName == 'VIRTUAL ACCOUNT' || empty($bankName)) {
                            $bankName = 'BANK VA';
                        }

                        // Diperbaiki menggunakan setTimezone('Asia/Jakarta') agar waktu sesuai lokal WIB
                        $expiryFormatted = \Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Jakarta')->addMinutes(15)->translatedFormat('d M Y, H:i');
                    @endphp

                    @if ($isVa)
                        <!-- TAMPILAN INSTRUKSI VIRTUAL ACCOUNT PROFESIONAL -->
                        <div class="bg-gray-900 p-6 rounded-2xl border border-gray-700 max-w-lg mx-auto space-y-5 text-left">
                            
                            <!-- Header Merchant (Blok Putih BNI Dihapus) -->
                            <div class="flex justify-between items-center border-b border-gray-800 pb-3">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider text-gray-400 block">Merchant</span>
                                    <span class="text-xs font-bold text-white">KonserTix Official</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] uppercase tracking-wider text-gray-400 block">Bank VA</span>
                                    <span class="text-xs font-bold text-indigo-400 uppercase">{{ $order->payment_method }}</span>
                                </div>
                            </div>

                            <!-- Nomor Virtual Account Box & Tombol Salin Interaktif -->
                            <div class="space-y-1.5">
                                <label class="text-xs text-gray-400 block flex justify-between items-center">
                                    <span>Nomor Virtual Account:</span>
                                    <span class="text-[11px] text-amber-400 font-semibold"><i class="fa-regular fa-clock"></i> Bayar Sebelum: {{ $expiryFormatted }} WIB</span>
                                </label>
                                <div class="bg-gray-950 border border-indigo-500/50 p-4 rounded-xl flex items-center justify-between">
                                    <span id="vaNumberText" class="font-mono font-black text-white text-base sm:text-lg tracking-wider">{{ $vaNumber }}</span>
                                    <button id="copyBtn" onclick="copyVaNumber()" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-3.5 py-2 rounded-lg transition flex items-center gap-1.5 shadow-md">
                                        <i class="fa-regular fa-copy" id="copyIcon"></i>
                                        <span id="copyBtnText">Salin Kode</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Detail Tagihan -->
                            <div class="bg-gray-950/60 p-3.5 rounded-xl border border-gray-800 flex justify-between items-center text-xs">
                                <span class="text-gray-400">Total Tagihan Pembayaran:</span>
                                <span class="text-indigo-400 font-extrabold text-sm sm:text-base">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>

                            <!-- Petunjuk Cara Bayar Dinamik -->
                            <div class="space-y-2 text-xs text-gray-300 pt-2 border-t border-gray-800">
                                <p class="font-bold text-white mb-1"><i class="fa-solid fa-circle-info text-indigo-400"></i> Petunjuk Pembayaran:</p>
                                <ol class="list-decimal list-inside space-y-1 text-gray-400 text-[11px] leading-relaxed">
                                    <li>Buka aplikasi <strong class="text-white">{{ $bankName }} Mobile Banking</strong> atau ATM pilihan Anda.</li>
                                    <li>Pilih menu <strong class="text-white">Transfer > Virtual Account Billing</strong>.</li>
                                    <li>Masukkan nomor Virtual Account: <strong class="text-indigo-300 font-mono">{{ $vaNumber }}</strong>.</li>
                                    <li>Periksa detail tagihan atas nama <strong class="text-white">KonserTix</strong> lalu konfirmasi pembayaran.</li>
                                </ol>
                            </div>

                            <!-- Tombol Simulasi Selesai -->
                            <div class="pt-3 border-t border-gray-800 space-y-2">
                                <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-emerald-600/30 text-xs flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>Simulasi Pembayaran Selesai</span>
                                    </button>
                                </form>
                                
                                <p class="text-[10px] text-gray-500 italic text-center">
                                    <i class="fa-solid fa-rotate text-emerald-500 animate-spin"></i> Sistem mendeteksi transaksi secara otomatis setelah pembayaran berhasil.
                                </p>
                            </div>
                        </div>

                        <!-- JavaScript Feedback Interaktif Tombol Salin (2 Detik) -->
                        <script>
                            function copyVaNumber() {
                                const vaText = document.getElementById('vaNumberText').innerText;
                                const btnText = document.getElementById('copyBtnText');
                                const copyBtn = document.getElementById('copyBtn');
                                const copyIcon = document.getElementById('copyIcon');

                                navigator.clipboard.writeText(vaText).then(() => {
                                    btnText.textContent = '✓ Tersalin!';
                                    copyIcon.className = 'fa-solid fa-check text-emerald-300';
                                    copyBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
                                    copyBtn.classList.add('bg-emerald-600');

                                    setTimeout(() => {
                                        btnText.textContent = 'Salin Kode';
                                        copyIcon.className = 'fa-regular fa-copy';
                                        copyBtn.classList.remove('bg-emerald-600');
                                        copyBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
                                    }, 2000);
                                });
                            }
                        </script>
                    @else
                        <!-- TAMPILAN INSTRUKSI QRIS -->
                        <div class="bg-gray-900 p-6 rounded-2xl border border-gray-700 max-w-md mx-auto space-y-4">
                            <div class="flex flex-col items-center justify-center space-y-1">
                                <div class="flex items-center gap-1.5 bg-white px-3 py-1 rounded-md shadow">
                                    <span class="bg-red-600 text-white font-black px-1.5 py-0.5 rounded text-[10px] tracking-wider">QRIS</span>
                                    <span class="text-[10px] font-bold text-gray-800 tracking-tight">QUICK RESPONSE CODE INDONESIA STANDARD</span>
                                </div>
                                <span class="text-[11px] text-gray-400 font-medium">Scan QR Code untuk Membayar</span>
                            </div>

                            <div class="flex flex-col items-center space-y-2">
                                <div class="bg-white p-3.5 inline-block rounded-2xl shadow-xl">
                                    <img id="qrisImage" src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=KONSERTIX-PAY-{{ $order->order_number }}-{{ $order->total_amount }}" alt="QRIS QR Code" class="w-40 h-40 mx-auto rounded-lg">
                                </div>
                                
                                <a href="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=KONSERTIX-PAY-{{ $order->order_number }}-{{ $order->total_amount }}" target="_blank" download="QRIS-KonserTix-{{ $order->order_number }}.png" class="text-[11px] font-semibold text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 transition">
                                    <i class="fa-solid fa-download"></i>
                                    <span>Simpan / Unduh Gambar QR</span>
                                </a>
                            </div>

                            <div class="space-y-1 text-xs text-gray-300">
                                <p class="font-semibold text-white">Total Tagihan: <span class="text-indigo-400 font-extrabold text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                                <p class="text-[11px] text-gray-400">Scan menggunakan BCA, Mandiri, GoPay, OVO, DANA, atau ShopeePay.</p>
                            </div>

                            <div class="pt-2 border-t border-gray-800 space-y-2">
                                <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-emerald-600/30 text-xs flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>Pembayaran Selesai</span>
                                    </button>
                                </form>
                                
                                <p class="text-[10px] text-gray-500 italic flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-rotate text-emerald-500 animate-spin"></i>
                                    <span>Sistem akan mengonfirmasi pembayaran Anda secara otomatis.</span>
                                </p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="bg-gray-900 print:bg-white p-6 rounded-2xl border border-gray-700 print:border-black inline-block w-full text-center space-y-3">
                        <p class="text-xs text-emerald-400 font-semibold flex items-center justify-center gap-1.5 print-text-dark">
                            <i class="fa-solid fa-qrcode"></i>
                            <span>Tunjukkan QR Code Ini Saat Check-in di Venue</span>
                        </p>
                        
                        <!-- QR Code E-Tiket Aktif -->
                        <div class="bg-white p-3 inline-block rounded-xl shadow-lg my-2 border print:border-black">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $order->order_number }}" alt="QR Code E-Tiket" class="w-32 h-32 mx-auto">
                        </div>

                        <div class="font-mono text-xl font-extrabold tracking-widest text-indigo-300 bg-gray-800 print:bg-gray-100 py-2.5 rounded-lg border border-gray-700 print:border-black print-text-dark">
                            {{ $order->order_number }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Syarat & Ketentuan Resmi (Bahasa Baku) -->
            <div class="pt-4 border-t border-dashed border-gray-600 print:border-black text-[10px] text-gray-400 print-text-dark space-y-1">
                <p class="font-bold text-gray-300 print:text-black">⚠️ Syarat & Ketentuan Masuk Venue:</p>
                <p>1. Harap membawa KTP/SIM asli yang sesuai dengan nama pemegang tiket serta NIK terdaftar saat memasuki area konser.</p>
                <p>2. E-tiket resmi ini hanya berlaku untuk 1 kali pemindaian (1x scan) di pintu masuk utama.</p>
            </div>
        </div>

        <!-- Tombol Cetak / PDF -->
        @if ($order->status === 'paid')
            <div class="no-print flex flex-col sm:flex-row gap-3 pt-2">
                <button onclick="window.print()" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak / Simpan PDF E-Tiket</span>
                </button>
                <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-3 rounded-xl transition border border-gray-700 text-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Lihat Semua Tiket Saya</span>
                </a>
            </div>
        @endif
    </main>

    <!-- Footer Simple -->
    <footer class="no-print text-center text-xs text-gray-600 py-4">
        &copy; {{ date('Y') }} KonserTix. All rights reserved.
    </footer>

    <!-- JAVASCRIPT: Countdown Timer -->
    @if ($order->status === 'pending')
    <script>
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
                alert("Waktu pembayaran pesanan Anda telah berakhir.");
                window.location.href = "{{ route('dashboard') }}";
            }
        }, 1000);
    </script>
    @endif

</body>
</html>