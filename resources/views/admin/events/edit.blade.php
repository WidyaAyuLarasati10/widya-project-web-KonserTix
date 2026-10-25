<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - KonserTix Admin</title>
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
                <i class="fa-solid fa-pen-to-square text-indigo-500"></i>
                <span>Edit Event Konser</span>
            </h1>
            <a href="{{ route('admin.dashboard') }}" class="text-xs text-gray-400 hover:text-white transition">
                <i class="fa-solid fa-xmark text-base"></i>
            </a>
        </div>

        {{-- Menampilkan Pesan Error Validasi jika ada --}}
        @if ($errors->any())
            <div class="bg-rose-500/20 border border-rose-500 text-rose-300 p-3 rounded-xl text-xs mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <h2 class="text-sm font-bold text-indigo-400 border-b border-gray-800 pb-2">1. Maklumat Acara</h2>
                
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">Nama Konser / Artis</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                </div>

                {{-- Tambahan Pilihan Kategori Konser (Nasional/Internasional) --}}
                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">Kategori Konser</label>
                    <select name="category" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                        <option value="national" {{ old('category', $event->category) == 'national' ? 'selected' : '' }}>Nasional (National)</option>
                        <option value="international" {{ old('category', $event->category) == 'international' ? 'selected' : '' }}>Internasional (International)</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1">Lokasi Konser</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-300 mb-1">Tanggal & Waktu</label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date', date('Y-m-d\TH:i', strtotime($event->event_date))) }}" required class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-300">Ganti Gambar Poster / Banner (Opsional)</label>
                    <input type="file" name="banner_file" accept="image/*" class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-2.5 rounded-xl file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 mb-1">Deskripsi Ringkas</label>
                    <textarea name="description" rows="2" class="w-full bg-gray-950 border border-gray-700 text-white text-xs p-3 rounded-xl focus:outline-none focus:border-indigo-500">{{ old('description', $event->description) }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                    <h2 class="text-sm font-bold text-indigo-400">2. Kategori & Kuota Tiket</h2>
                    <button type="button" onclick="addTicketRow()" class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 border border-indigo-500/30 text-xs font-bold px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Kategori Tiket</span>
                    </button>
                </div>

                <div id="ticketCategoriesContainer" class="space-y-3">
                    @foreach($event->ticketCategories as $index => $category)
                        <div class="ticket-row bg-gray-950 border border-gray-800 p-3.5 rounded-xl grid grid-cols-1 sm:grid-cols-12 gap-2.5 items-center">
                            <div class="sm:col-span-5">
                                <label class="block text-[10px] font-semibold text-gray-400 mb-1">Nama Kategori</label>
                                <input type="text" name="tickets[{{ $index }}][name]" value="{{ $category->name }}" required class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="sm:col-span-4">
                                <label class="block text-[10px] font-semibold text-gray-400 mb-1">Harga (Rp)</label>
                                <input type="number" name="tickets[{{ $index }}][price]" value="{{ (int)$category->price }}" required class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-semibold text-gray-400 mb-1">Kuota/Stok</label>
                                <input type="number" name="tickets[{{ $index }}][stock]" value="{{ $category->stock }}" required class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                            </div>
                            <div class="sm:col-span-1 text-right pt-3 sm:pt-0">
                                <button type="button" onclick="removeTicketRow(this)" class="text-rose-400 hover:text-rose-300 p-1 rounded-lg transition" title="Hapus Kategori">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-gray-300 text-xs font-semibold px-4 py-2.5 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        let ticketRowIndex = {{ count($event->ticketCategories) }};

        function addTicketRow() {
            const container = document.getElementById('ticketCategoriesContainer');
            const newRow = document.createElement('div');
            newRow.className = 'ticket-row bg-gray-950 border border-gray-800 p-3.5 rounded-xl grid grid-cols-1 sm:grid-cols-12 gap-2.5 items-center';
            newRow.innerHTML = `
                <div class="sm:col-span-5">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Nama Kategori</label>
                    <input type="text" name="tickets[${ticketRowIndex}][name]" required placeholder="Contoh: CAT 1 Standing" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                </div>
                <div class="sm:col-span-4">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Harga (Rp)</label>
                    <input type="number" name="tickets[${ticketRowIndex}][price]" required placeholder="500000" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Kuota/Stok</label>
                    <input type="number" name="tickets[${ticketRowIndex}][stock]" required placeholder="150" class="w-full bg-gray-900 border border-gray-700 text-white text-xs p-2 rounded-lg focus:outline-none focus:border-indigo-500">
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

        function removeTicketRow(button) {
            const rows = document.querySelectorAll('.ticket-row');
            if (rows.length > 1) {
                button.closest('.ticket-row').remove();
            } else {
                alert('Acara harus memiliki minimal satu kategori tiket!');
            }
        }
    </script>
</body>
</html>