<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru - KonserTix Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #0b0f19; color: #f3f4f6; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 flex justify-center items-center">

    <div class="max-w-4xl w-full bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 shadow-2xl space-y-6">
        <div class="flex items-center justify-between border-b border-gray-800 pb-4">
            <h1 class="text-xl font-black text-white flex items-center gap-2">
                <i class="fa-solid fa-calendar-plus text-indigo-500"></i>
                <span>Tambah Event Konser Baru</span>
            </h1>
            <a href="{{ route('admin.dashboard') }}" class="text-xs text-gray-400 hover:text-white transition">
                <i class="fa-solid fa-xmark text-base"></i>
            </a>
        </div>

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 1. MAKLUMAT UTAMA ACARA -->
            <div class="space-y-4">
                <h2 class="text-sm font-bold text-indigo-400 border-b border-gray-800 pb-2">1. Maklumat Acara</h2>
                
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">Nama Konser / Artis</label>
                    <input type="text" name="title" required placeholder="Contoh: Coldiac - Heartbeat Tour 2026" class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1">Lokasi Konser</label>
                        <input type="text" name="location" required placeholder="Contoh: Stadion Manahan, Surakarta" class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1">Tanggal & Waktu</label>
                        <input type="datetime-local" name="event_date" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1">Kategori Event</label>
                        <select name="category" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                            <option value="national">🇮🇩 Nasional (ID)</option>
                            <option value="international">🌍 Internasional</option>
                        </select>
                    </div>
                </div>

                <!-- PREVIEW & INPUT POSTER -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-gray-300">Muat Naik Gambar Poster / Banner</label>
                        <input type="file" name="banner_file" accept="image/*" id="bannerInput" onchange="previewImage(event)" class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-2.5 rounded-xl file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
                        <p class="text-[10px] text-gray-500">Format: JPG, PNG, WEBP (Max 2MB)</p>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-full h-24 bg-gray-950 border border-dashed border-gray-700 rounded-xl flex items-center justify-center overflow-hidden relative">
                            <img id="imagePreview" src="#" alt="Preview" class="hidden w-full h-full object-cover">
                            <span id="previewPlaceholder" class="text-[10px] text-gray-500 text-center px-2">Preview Poster</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">Deskripsi Ringkas</label>
                    <textarea name="description" rows="2" placeholder="Tuliskan deskripsi ringkas konser..." class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500"></textarea>
                </div>
            </div>

            <!-- 2. KONFIGURASI KATEGORI TIKET DINAMIK -->
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                    <h2 class="text-sm font-bold text-indigo-400">2. Kategori & Kuota Tiket</h2>
                    <button type="button" onclick="addTicketRow()" class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 border border-indigo-500/30 text-xs font-bold px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Kategori Tiket</span>
                    </button>
                </div>

                <div id="ticketCategoriesContainer" class="space-y-3">
                    <!-- Baris Kategori Tiket Default -->
                    <div class="ticket-row bg-gray-950 border border-gray-800 p-3.5 rounded-xl grid grid-cols-1 sm:grid-cols-12 gap-2.5 items-center">
                        <div class="sm:col-span-4">
                            <label class="block text-[10px] font-semibold text-gray-400 mb-1">Nama Kategori</label>
                            <input type="text" name="tickets[0][name]" required placeholder="Contoh: VIP Restoe Boemi" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="sm:col-span-3">
                            <label class="block text-[10px] font-semibold text-gray-400 mb-1">Harga (Rp)</label>
                            <input type="number" name="tickets[0][price]" required placeholder="750000" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[10px] font-semibold text-gray-400 mb-1">Kuota/Stok</label>
                            <input type="number" name="tickets[0][stock]" required placeholder="100" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[10px] font-semibold text-gray-400 mb-1">Tempat Duduk</label>
                            <select name="tickets[0][seating_type]" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                                <option value="free_standing">Free Standing</option>
                                <option value="numbered_seating">Numbered Seating</option>
                            </select>
                        </div>
                        <div class="sm:col-span-1 text-right pt-3 sm:pt-0">
                            <button type="button" onclick="removeTicketRow(this)" class="text-rose-400 hover:text-rose-300 p-1 rounded-lg transition" title="Hapus Kategori">
                                <i class="fa-solid fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BUTANG AKSI -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-300 text-xs font-semibold px-4 py-2.5 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Event & Tiket</span>
                </button>
            </div>
        </form>
    </div>

    <!-- JAVASCRIPT UNTUK PREVIEW & DYNAMIC TICKET ROWS -->
    <script>
        let ticketRowIndex = 1;

        // Preview Gambar Poster
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('previewPlaceholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Tambah Baris Kategori Tiket
        function addTicketRow() {
            const container = document.getElementById('ticketCategoriesContainer');
            const newRow = document.createElement('div');
            newRow.className = 'ticket-row bg-gray-950 border border-gray-800 p-3.5 rounded-xl grid grid-cols-1 sm:grid-cols-12 gap-2.5 items-center';
            newRow.innerHTML = `
                <div class="sm:col-span-4">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Nama Kategori</label>
                    <input type="text" name="tickets[${ticketRowIndex}][name]" required placeholder="Contoh: CAT 1 Standing" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Harga (Rp)</label>
                    <input type="number" name="tickets[${ticketRowIndex}][price]" required placeholder="500000" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Kuota/Stok</label>
                    <input type="number" name="tickets[${ticketRowIndex}][stock]" required placeholder="150" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Tempat Duduk</label>
                    <select name="tickets[${ticketRowIndex}][seating_type]" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                        <option value="free_standing">Free Standing</option>
                        <option value="numbered_seating">Numbered Seating</option>
                    </select>
                </div>
                <div class="sm:col-span-1 text-right pt-3 sm:pt-0">
                    <button type="button" onclick="removeTicketRow(this)" class="text-rose-400 hover:text-rose-300 p-1 rounded-lg transition" title="Hapus Kategori">
                        <i class="fa-solid fa-trash-can text-sm"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            ticketRowIndex++;
        }

        // Hapus Baris Kategori Tiket
        function removeTicketRow(button) {
            const rows = document.querySelectorAll('.ticket-row');
            if (rows.length > 1) {
                button.closest('.ticket-row').remove();
            } else {
                alert('Acara sekurang-kurangnya mesti mempunyai satu kategori tiket!');
            }
        }
    </script>

</body>
</html>