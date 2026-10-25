<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - KonserTix</title>
    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col justify-between p-4 font-sans relative overflow-x-hidden">

    <!-- Glow Background Blur -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-indigo-600/15 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Tombol Kembali ke Beranda -->
    <header class="max-w-md w-full mx-auto pt-2 z-10">
        <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-300 hover:text-white bg-gray-800/80 hover:bg-gray-700 px-3.5 py-2 rounded-xl transition border border-gray-700 backdrop-blur-md">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </header>

    <!-- Main Card Forgot Password -->
    <main class="flex-grow flex items-center justify-center my-6 z-10">
        <div class="max-w-md w-full bg-gray-800 rounded-2xl border border-gray-700 shadow-2xl p-8 backdrop-blur-xl space-y-6">
            
            <!-- Header / Logo Brand KonserTix -->
            <div class="text-center space-y-2">
                <a href="/" class="inline-flex items-center space-x-2 text-3xl font-extrabold text-white tracking-wide mb-2">
                    <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
                    <span>Konser<span class="text-indigo-500">Tix</span></span>
                </a>
                <h2 class="text-xl font-semibold text-gray-200">Reset Kata Sandi</h2>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Lupa kata sandi Anda? Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pemulihan kata sandi melalui email.
                </p>
            </div>

            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" autocomplete="off" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 text-xs">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="off" 
                               placeholder="nama@email.com" 
                               class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs" />
                </div>

                <!-- Tombol Kirim Tautan -->
                <div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm flex items-center justify-center gap-2">
                        <span>Kirim Tautan Reset Kata Sandi</span>
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                    </button>
                </div>
            </form>

            <!-- Link ke Halaman Login -->
            <div class="text-center pt-4 border-t border-gray-700/60 text-sm text-gray-400">
                Sudah ingat kata sandi? 
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                    Kembali ke Login
                </a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-gray-500 py-2">
        &copy; {{ date('Y') }} KonserTix. All rights reserved.
    </footer>

</body>
</html>