<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
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
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(51, 65, 85, 0.8);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #091a2f 0%, #032b56 100%);
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
    </style>
</head>
<body class="bg-[#f0f4f9] dark:bg-slate-950 flex min-h-screen text-slate-800 dark:text-slate-100 transition-colors duration-300">

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
                <a href="/admin/dashboard" class="flex items-center gap-3.5 py-3 px-4 rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/30 transition duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/admin/destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
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

    <!-- Main Content Container -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- Header Topbar -->
        <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-3.5 flex justify-between items-center sticky top-0 z-50 transition-colors">
            <div class="flex items-center gap-4">
                <button class="text-slate-500 dark:text-slate-400 hover:text-slate-800 md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Search Box -->
                <div class="relative w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Cari destinasi, kategori, atau laporan..." class="w-full pl-10 pr-16 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 border border-transparent focus:bg-white dark:focus:bg-slate-900 focus:border-sky-400 focus:outline-none text-xs text-slate-700 dark:text-slate-200 transition">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                        <kbd class="px-1.5 py-0.5 text-[9px] font-semibold text-slate-400 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded">Ctrl + K</kbd>
                    </span>
                </div>
            </div>

            <!-- Profile, Notifications & Theme Toggle -->
            <div class="flex items-center gap-3">
                
                <!-- Tombol Lonceng & Pop-up Notifikasi -->
                <div class="relative" x-data="{ open: false, hasUnread: true }">
                    <button @click="open = !open; hasUnread = false" class="relative w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <!-- Titik Merah (Hilang otomatis saat diklik) -->
                        <span x-show="hasUnread" class="absolute top-1 right-1 w-2.5 h-2.5 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-900 animate-pulse"></span>
                    </button>

                    <!-- Pop-up Box Notifikasi -->
                    <div x-show="open" @click.away="open = false" style="display: none;" class="absolute right-0 mt-3 w-80 bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 py-3 z-50 text-slate-800 dark:text-slate-100 animate__animated animate__fadeInUp animate__faster">
                        <div class="px-4 pb-2 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                            <h4 class="font-bold text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Notifikasi Sistem</h4>
                            <span class="text-[10px] bg-sky-50 dark:bg-sky-900/40 text-sky-600 dark:text-sky-400 font-bold px-2 py-0.5 rounded-full">Terbaru</span>
                        </div>
                        <div class="max-h-72 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-700">
                            
                            <!-- Looping Review Terbaru -->
                            @forelse($latestReviews ?? [] as $rev)
                            <a href="{{ route('admin.reviews.index') }}" class="p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 flex gap-3 transition block">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-xs">⭐</div>
                                <div>
                                    <p class="text-xs font-bold leading-tight">{{ $rev->user->name ?? 'User' }} memberi ulasan</p>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">"{{ $rev->review ?? $rev->komentar }}"</p>
                                    <span class="text-[9px] text-slate-400 mt-1 block">{{ $rev->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                            @empty
                            @endforelse

                            <!-- Looping Destinasi Baru -->
                            @forelse($latestDestinations ?? [] as $dest)
                            <a href="{{ route('admin.destinasi.show', $dest->id) }}" class="p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 flex gap-3 transition block">
                                <div class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0 font-bold text-xs">📍</div>
                                <div>
                                    <p class="text-xs font-bold leading-tight">Wisata baru diunggah</p>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $dest->nama_destinasi }}</p>
                                    <span class="text-[9px] text-slate-400 mt-1 block">{{ $dest->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>

                <!-- Tombol Toggle Tema Gelap / Terang (Dark / Light Mode) -->
                <button onclick="toggleTheme()" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-yellow-400 transition" title="Ubah Tema">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                <div class="h-6 w-[1px] bg-slate-200 dark:bg-slate-700 mx-1"></div>

                <!-- Profil Admin (Nama & Foto dari Database) -->
                <div class="flex items-center gap-2.5 cursor-pointer">
                    <div class="w-9 h-9 rounded-full bg-slate-300 dark:bg-slate-700 flex items-center justify-center text-slate-700 font-bold text-xs overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm">
                        @if(!empty($admin->foto))
                            <img src="{{ asset('storage/' . $admin->foto) }}" alt="Foto Admin" class="w-full h-full object-cover">
                        @else
                            👤
                        @endif
                    </div>
                    <div class="text-left hidden sm:block">
                        <h4 class="text-xs font-bold text-slate-800 dark:text-slate-100 leading-none">{{ $admin->name ?? 'Admin Panel' }}</h4>
                        <p class="text-[10px] text-slate-400 dark:text-slate-400 mt-0.5">Administrator</p>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </header>

        <!-- Body Dashboard -->
        <div class="p-8">
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-sky-500 to-cyan-400 text-white p-8 mb-8 shadow-xl animate__animated animate__fadeIn">
                <div class="relative z-10 max-w-2xl">
                    <h2 class="text-3xl font-black tracking-tight mb-2">Selamat Datang, Admin!</h2>
                    <p class="text-sm text-sky-100 font-medium">Kelola destinasi wisata Ciwidey dengan mudah bersama Lokalify.</p>
                </div>
                <!-- Background decorative shape/gradient elements -->
                <div class="absolute right-6 bottom-2 opacity-25 text-8xl pointer-events-none">
                    🏔️
                </div>
            </div>

            <!-- Stats Cards Grid (Kini bisa diklik dan mengarah ke halaman masing-masing) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <!-- Kotak 1: Total Destinasi -->
                <a href="{{ route('admin.destinasi.index') }}" class="glass-card p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 block">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 dark:text-slate-400 tracking-wider uppercase mb-1">Total Destinasi</p>
                            <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $totalDestinasi }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-sky-500 text-white flex items-center justify-center text-xl shadow-lg shadow-sky-500/30">
                            📍
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-emerald-600 dark:text-emerald-400">↑ 100% <span class="text-slate-400 font-normal">Dari bulan lalu</span></span>
                        <span class="text-sky-600 dark:text-sky-400">Kelola →</span>
                    </div>
                </a>

                <!-- Kotak 2: Total User -->
                <a href="{{ route('admin.users.index') }}" class="glass-card p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 block">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 dark:text-slate-400 tracking-wider uppercase mb-1">Total User</p>
                            <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $totalUser }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500 text-white flex items-center justify-center text-xl shadow-lg shadow-indigo-500/30">
                            👥
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-emerald-600 dark:text-emerald-400">↑ 100% <span class="text-slate-400 font-normal">Dari bulan lalu</span></span>
                        <span class="text-indigo-600 dark:text-indigo-400">Lihat →</span>
                    </div>
                </a>

                <!-- Kotak 3: Total Ulasan -->
                <a href="{{ route('admin.reviews.index') }}" class="glass-card p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 block">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 dark:text-slate-400 tracking-wider uppercase mb-1">Total Ulasan</p>
                            <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $totalReview }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-xl shadow-lg shadow-emerald-500/30">
                            ⭐
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-500 dark:text-slate-400">→ 0% <span class="text-slate-400 font-normal">Dari bulan lalu</span></span>
                        <span class="text-emerald-600 dark:text-emerald-400">Ulasan →</span>
                    </div>
                </a>

                <!-- Kotak 4: Laporan Pending -->
                <a href="{{ route('admin.laporan.pending') }}" class="glass-card p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 block">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[11px] font-bold text-slate-500 dark:text-slate-400 tracking-wider uppercase mb-1">Laporan Pending</p>
                            <h3 class="text-3xl font-black text-amber-600 dark:text-amber-500">{{ $totalLaporan }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl shadow-lg shadow-amber-500/30">
                            🚨
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-500 dark:text-slate-400">→ 0% <span class="text-slate-400 font-normal">Dari bulan lalu</span></span>
                        <span class="text-amber-600 dark:text-amber-400">Tinjau →</span>
                    </div>
                </a>

            </div>
        </div>
    </main>

    <!-- Alpine.js untuk Pop-up Notifikasi -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function toggleTheme() {
            const body = document.documentElement;
            body.classList.toggle('dark');
            if (body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }

        // Pertahankan tema saat halaman dimuat ulang
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>