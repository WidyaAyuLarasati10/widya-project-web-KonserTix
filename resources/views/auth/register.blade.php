<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - KonserTix</title>
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

    <!-- Main Card Register -->
    <main class="flex-grow flex items-center justify-center my-6 z-10">
        <div class="max-w-md w-full bg-gray-800 rounded-2xl border border-gray-700 shadow-2xl p-8 backdrop-blur-xl">
            
            <!-- Header / Logo Brand KonserTix -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center space-x-2 text-3xl font-extrabold text-white tracking-wide mb-2">
                    <span class="text-indigo-500"><i class="fa-solid fa-music"></i></span>
                    <span>Konser<span class="text-indigo-500">Tix</span></span>
                </a>
                <h2 class="text-xl font-semibold text-gray-200">Buat Akun Baru</h2>
                <p class="text-sm text-gray-400 mt-1">Daftar sekarang untuk memesan tiket konser favoritmu</p>
            </div>

            <form method="POST" action="{{ route('register') }}" autocomplete="off" class="space-y-4">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 text-xs">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="off" 
                               placeholder="Nama Lengkap" 
                               class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-400 text-xs" />
                </div>

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
                               autocomplete="off" 
                               placeholder="nama@email.com" 
                               class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs" />
                </div>

                <!-- Kata Sandi dengan Toggle Show/Hide -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 text-xs">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password" 
                               placeholder="••••••••" 
                               class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-xl pl-10 pr-10 py-3 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        <button type="button" onclick="togglePass('password', 'eyeIcon1')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-500 hover:text-gray-300 transition">
                            <i class="fa-solid fa-eye" id="eyeIcon1"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400 text-xs" />
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 text-xs">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password" 
                               placeholder="••••••••" 
                               class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-xl pl-10 pr-10 py-3 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        <button type="button" onclick="togglePass('password_confirmation', 'eyeIcon2')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-500 hover:text-gray-300 transition">
                            <i class="fa-solid fa-eye" id="eyeIcon2"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-400 text-xs" />
                </div>

                <!-- Tombol Daftar -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-indigo-600/30 text-sm flex items-center justify-center gap-2">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                </div>
            </form>

            <!-- Link ke Halaman Login -->
            <div class="text-center mt-6 pt-6 border-t border-gray-700/60 text-sm text-gray-400">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                    Masuk di sini
                </a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-gray-500 py-2">
        &copy; {{ date('Y') }} KonserTix. All rights reserved.
    </footer>

    <!-- Script Intip Password -->
    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            if (type === 'text') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>