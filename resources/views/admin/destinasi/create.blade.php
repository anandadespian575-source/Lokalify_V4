<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi - Lokalify Admin 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #091a2f 0%, #032b56 100%);
        }
        /* Custom Input Glow & Focus Effect */
        .input-futuristic {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-futuristic:focus {
            background-color: #ffffff;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-[#f0f4f9] flex min-h-screen text-slate-800">

    <!-- Sidebar Navigation -->
    <aside class="w-64 sidebar-gradient text-white p-5 flex flex-col justify-between hidden md:flex shrink-0 shadow-xl border-r border-slate-800/50">
        <div>
            <!-- Logo Header -->
            <div class="flex items-center gap-3 mb-8 px-2 group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-xl shadow-lg shadow-sky-500/30 group-hover:scale-105 transition-transform duration-300">
                    🏔️
                </div>
                <div>
                    <h1 class="text-xl font-black text-white tracking-tight">Lokalify</h1>
                    <p class="text-[10px] text-sky-300 font-medium tracking-wide">Jelajahi Ciwidey, Temukan Cerita</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5 text-sm font-semibold">
                <a href="/admin/dashboard" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/admin/destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/30 transition duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Kelola Destinasi
                </a>
                <a href="/admin/kategori" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </a>
                <a href="/admin/laporan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Laporan User
                </a>
                <a href="/admin/laporan-destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan Destinasi
                </a>
                <a href="/admin/pengaturan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan
                </a>
            </nav>

            <!-- Sidebar Promo Card -->
            <div class="mt-8 relative overflow-hidden rounded-2xl p-4 bg-gradient-to-b from-sky-400/20 to-blue-600/30 border border-sky-400/30">
                <div class="relative z-10">
                    <p class="text-xs font-bold text-sky-300">Jelajah Ciwidey</p>
                    <p class="text-[11px] text-slate-200 mt-0.5 mb-3">Bersama Lokalify!</p>
                    <button class="w-8 h-8 rounded-full bg-white text-sky-900 flex items-center justify-center font-bold text-sm shadow-md hover:scale-110 transition">
                        →
                    </button>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="pt-6">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full bg-slate-900/60 hover:bg-red-500/20 text-slate-300 hover:text-red-400 py-3 rounded-xl font-bold text-xs transition-all duration-200 flex items-center justify-center gap-2 border border-slate-700/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- Topbar Navigation -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-8 py-3.5 flex justify-between items-center sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <button class="text-slate-500 hover:text-slate-800 md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Search Box -->
                <div class="relative w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Cari destinasi, kategori, atau laporan..." class="w-full pl-10 pr-16 py-2 rounded-xl bg-slate-100 border border-transparent focus:bg-white focus:border-sky-400 focus:outline-none text-xs text-slate-700 transition">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                        <kbd class="px-1.5 py-0.5 text-[9px] font-semibold text-slate-400 bg-white border border-slate-200 rounded">Ctrl + K</kbd>
                    </span>
                </div>
            </div>

            <!-- Profile & Notifications -->
            <div class="flex items-center gap-3">
                <button class="relative w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-red-500"></span>
                </button>
                <button class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                <div class="h-6 w-[1px] bg-slate-200 mx-1"></div>

                <div class="flex items-center gap-2.5 cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-slate-300 flex items-center justify-center text-slate-700 font-bold text-xs overflow-hidden border border-slate-200">
                        👤
                    </div>
                    <div class="text-left hidden sm:block">
                        <h4 class="text-xs font-bold text-slate-800 leading-none">Admin Panel</h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">Administrator</p>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </header>

        <!-- Body Content -->
        <div class="p-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 animate__animated animate__fadeInDown">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                        Tambah Destinasi Baru <span class="text-xl">🗺️</span>
                    </h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Masukkan informasi detail tempat wisata lokal dengan lengkap.</p>
                </div>
                <a href="/admin/destinasi" class="bg-slate-200/80 hover:bg-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-sm hover:-translate-x-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>

            <!-- Form Card Container -->
            <div class="glass-card rounded-3xl shadow-xl p-8 animate__animated animate__fadeInUp max-w-4xl mx-auto border border-slate-200/80">
                <form action="/admin/destinasi" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nama Destinasi -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-sky-500">📍</span> Nama Destinasi
                        </label>
                        <input type="text" name="nama_destinasi" required placeholder="Contoh: Ecopark Curug Tilu" 
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400">
                    </div>

                    <!-- Kategori Wisata -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-sky-500">🏷️</span> Kategori Wisata
                        </label>
                        <div class="relative">
                            <select name="kategori_id" required 
                                class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-semibold text-slate-700 input-futuristic appearance-none cursor-pointer">
                                <option value="" disabled selected class="text-slate-400">Pilih kategori wisata...</option>
                                @foreach($kategori ?? [] as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </div>
                    </div>

                    <!-- Dual Detail: Profil Singkat & Detail Lengkap -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                <span class="text-amber-500">✨</span> Profil Singkat (Highlight)
                            </label>
                            <textarea name="deskripsi_singkat" rows="3" required placeholder="Deskripsi ringkas untuk kartu preview..."
                                class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                <span class="text-sky-500">📋</span> Detail Lengkap & Fasilitas
                            </label>
                            <textarea name="deskripsi_lengkap" rows="3" required placeholder="Informasi mendalam, fasilitas, daya tarik, dll..."
                                class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400 resize-none"></textarea>
                        </div>
                    </div>

                    <!-- Foto Wisata Dropzone Minimalis -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-indigo-500">📸</span> Foto Utama Wisata
                        </label>
                        <div class="relative group border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-2xl p-4 bg-slate-50/50 hover:bg-sky-50/30 transition text-center cursor-pointer">
                            <input type="file" name="foto" accept="image/*" required id="fotoInput" onchange="previewFileName(this)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="flex flex-col items-center justify-center py-2">
                                <div class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                                    🖼️
                                </div>
                                <p id="fileNameDisplay" class="text-xs font-bold text-slate-700">Klik atau seret file gambar ke sini</p>
                                <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, JPEG (Maks. 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi / Alamat -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-red-500">📍</span> Lokasi / Alamat Lengkap
                        </label>
                        <input type="text" name="alamat" required placeholder="Contoh: Jl. Raya Ciwidey - Patengan, Rancabali, Bandung" 
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400">
                    </div>

                    <!-- Jam Operasional -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-emerald-500">⏰</span> Jam Operasional Wisata
                        </label>
                        <div class="mb-3">
                            <input type="text" id="inputJamBuka" name="jam_buka" required placeholder="Ketik manual (Contoh: 08:30 - 16:30)" 
                                class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400">
                        </div>
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-1">Pilih Cepat Instant:</span>
                            <button type="button" onclick="setJam('08:00 - 17:00')" class="px-3 py-1 rounded-xl text-[11px] font-semibold bg-white border border-slate-200 hover:border-sky-400 hover:bg-sky-50 text-slate-600 transition shadow-sm">08:00 - 17:00</button>
                            <button type="button" onclick="setJam('07:00 - 18:00')" class="px-3 py-1 rounded-xl text-[11px] font-semibold bg-white border border-slate-200 hover:border-sky-400 hover:bg-sky-50 text-slate-600 transition shadow-sm">07:00 - 18:00</button>
                            <button type="button" onclick="setJam('24 Jam')" class="px-3 py-1 rounded-xl text-[11px] font-semibold bg-white border border-slate-200 hover:border-sky-400 hover:bg-sky-50 text-slate-600 transition shadow-sm">24 Jam</button>
                            <button type="button" onclick="setJam('09:00 - 21:00')" class="px-3 py-1 rounded-xl text-[11px] font-semibold bg-white border border-slate-200 hover:border-sky-400 hover:bg-sky-50 text-slate-600 transition shadow-sm">09:00 - 21:00</button>
                        </div>
                    </div>

                    <!-- Link Google Maps -->
                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <span class="text-blue-500">🗺️</span> Link Google Maps / Koordinat GPS
                        </label>
                        <input type="text" name="link_maps" placeholder="Tempel link Google Maps atau koordinat..." 
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50/70 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic placeholder-slate-400">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="/admin/destinasi" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 transition">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-7 py-2.5 rounded-xl text-xs font-bold shadow-lg shadow-sky-500/25 transition hover:-translate-y-0.5 flex items-center gap-2">
                            <span>✨ Simpan Destinasi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function setJam(jam) {
            document.getElementById('inputJamBuka').value = jam;
        }

        function previewFileName(input) {
            if (input.files && input.files[0]) {
                document.getElementById('fileNameDisplay').textContent = "File Terpilih: " + input.files[0].name;
            }
        }
    </script>
</body>
</html>