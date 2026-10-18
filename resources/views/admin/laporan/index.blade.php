<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan User - Lokalify 📍</title>
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

    <!-- Sidebar Navigation (Disamakan persis seperti halaman Kategori di foto) -->
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
                <a href="/admin/destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Kelola Destinasi
                </a>
                <a href="/admin/kategori" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10 hover:text-white transition duration-200">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </a>
                <!-- Menu Laporan User (Aktif) -->
                <a href="/admin/laporan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/30 transition duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
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
            <header class="mb-6 animate__animated animate__fadeInDown">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Laporan User 🚨</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Daftar laporan yang dikirimkan oleh pengguna sistem.</p>
            </header>

            <div class="glass-card rounded-2xl shadow-sm border border-slate-200 overflow-hidden animate__animated animate__fadeInUp">
                <div class="p-4 border-b border-slate-100 bg-white">
                    <div class="text-xs font-bold text-slate-700">Daftar Laporan Masuk</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[11px] font-bold text-slate-500 uppercase tracking-wider bg-slate-50/70 border-b border-slate-100">
                                <th class="py-3.5 px-6">No</th>
                                <th class="py-3.5 px-6">Pelapor</th>
                                <th class="py-3.5 px-6">Foto Bukti</th>
                                <th class="py-3.5 px-6">Pesan Laporan</th>
                                <th class="py-3.5 px-6">Status</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-medium">
                            @forelse ($laporans as $index => $laporan)
                                <tr class="hover:bg-slate-50/80 transition duration-150">
                                    <td class="py-4 px-6 text-slate-400 font-bold">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 font-bold text-slate-800">{{ $laporan->user->name ?? 'User Tidak Dikenal' }}</td>
                                    <td class="py-4 px-6">
                                        @if($laporan->foto)
                                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="w-12 h-12 object-cover rounded-lg border">
                                        @else
                                            <span class="text-slate-400 italic">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 max-w-xs truncate">{{ $laporan->pesan }}</td>
                                    <td class="py-4 px-6">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold 
                                            {{ $laporan->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ ucfirst($laporan->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <a href="/admin/laporan/{{ $laporan->id }}" class="px-3.5 py-1.5 bg-sky-500 hover:bg-sky-600 text-white font-bold rounded-xl shadow-sm transition inline-flex items-center gap-1">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-slate-400 italic">Belum ada laporan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>