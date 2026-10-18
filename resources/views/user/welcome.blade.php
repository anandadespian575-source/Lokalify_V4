<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Lokalify</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .sidebar { background-color: #07162d; width: 260px; min-height: 100vh; position: fixed; }
        .nav-link:hover, .nav-link.active { background-color: #0ea5e9; color: #ffffff; border-radius: 8px; }
    </style>
</head>
<body class="flex">

    <!-- SIDEBAR -->
    <aside class="sidebar text-white flex flex-col justify-between p-4 shadow-xl">
        <div>
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3 px-2 py-3 mb-6">
                <div class="bg-cyan-500 p-2 rounded-lg text-white font-bold"><i class="fa-solid fa-mountain-sun"></i></div>
                <div>
                    <h1 class="font-bold text-lg tracking-wide">Lokalify</h1>
                    <p class="text-xs text-cyan-300">Jelajahi Ciwidey, Temukan Cerita</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <a href="{{ route('user.dashboard') }}" class="nav-link active flex items-center space-x-3 px-4 py-3 text-sm font-medium">
                    <i class="fa-solid fa-house w-5"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('user.wishlist') }}" class="nav-link flex items-center space-x-3 px-4 py-3 text-sm font-medium text-slate-300">
                    <i class="fa-solid fa-heart w-5 text-rose-400"></i> <span>Wishlist Saya</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="nav-link flex items-center space-x-3 px-4 py-3 text-sm font-medium text-slate-300">
                    <i class="fa-solid fa-gear w-5"></i> <span>Pengaturan Akun</span>
                </a>
            </nav>
        </div>

        <!-- Logout Button -->
        <div class="p-2 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm font-medium text-rose-400 hover:bg-rose-500/10 rounded-lg transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="ml-[260px] flex-1 min-h-screen flex flex-col">
        <!-- TOP NAVBAR -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 sticky top-0 z-20 shadow-sm">
            <!-- Search Bar -->
            <form action="{{ route('user.dashboard') }}" method="GET" class="relative w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fa-solid fa-magnifying-glass text-xs"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi, kategori, atau lokasi... Ctrl + K" class="w-full bg-slate-50 border border-slate-200 rounded-full pl-9 pr-4 py-1.5 text-xs text-slate-700 focus:outline-none focus:border-cyan-500 transition">
            </form>

            <!-- User Profile Top Right -->
            <div class="flex items-center space-x-4">
                <button class="relative text-slate-500 hover:text-slate-700"><i class="fa-regular fa-bell text-lg"></i></button>
                <div class="flex items-center space-x-3 border-l pl-4 border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-cyan-600 text-white flex items-center justify-center font-bold text-xs">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-semibold text-slate-800">{{ auth()->user()->name ?? 'User Panel' }}</p>
                        <p class="text-[10px] text-slate-500">Wisatawan Lokal</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <div class="p-8 space-y-6">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-cyan-600 to-blue-600 rounded-2xl p-8 text-white flex justify-between items-center shadow-lg relative overflow-hidden">
                <div class="relative z-10 space-y-2">
                    <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->name ?? 'Jelajahers' }}! 🏔️</h2>
                    <p class="text-sm text-cyan-100 max-w-xl">Temukan destinasi wisata impianmu di Ciwidey, simpan ke wishlist, baca ulasan, dan rencanakan liburanmu sekarang.</p>
                </div>
                <div class="hidden md:block opacity-20 text-8xl absolute right-10 -bottom-4">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <!-- KATEGORI FILTER -->
            <div class="flex items-center space-x-2 overflow-x-auto pb-2">
                <a href="{{ route('user.dashboard') }}" class="px-4 py-2 rounded-full text-xs font-medium {{ !request('kategori') ? 'bg-cyan-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                    Semua Kategori
                </a>
                @foreach($kategori as $kat)
                    <a href="{{ route('user.dashboard', ['kategori' => $kat->id]) }}" class="px-4 py-2 rounded-full text-xs font-medium whitespace-nowrap {{ request('kategori') == $kat->id ? 'bg-cyan-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                        {{ $kat->nama_kategori }}
                    </a>
                @endforeach
            </div>

            <!-- GRID DESTINASI -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($destinasi as $item)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <div class="relative h-48 bg-slate-100">
                                <img src="{{ asset('storage/' . ($item->foto_utama ?? 'default.jpg')) }}" alt="{{ $item->nama_destinasi }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-semibold text-cyan-700 shadow-sm">
                                    {{ $item->kategori->nama_kategori ?? 'Wisata Alam' }}
                                </span>
                            </div>
                            <div class="p-5 space-y-2">
                                <h3 class="font-bold text-slate-800 text-base">{{ $item->nama_destinasi }}</h3>
                                <p class="text-xs text-slate-500 flex items-center space-x-1.5">
                                    <i class="fa-solid fa-location-dot text-cyan-500"></i>
                                    <span class="truncate">{{ $item->lokasi }}</span>
                                </p>
                                <p class="text-xs text-slate-600 line-clamp-2 pt-1">{{ $item->profil_singkat }}</p>
                                <div class="flex items-center space-x-2 text-xs text-slate-500 pt-2 border-t border-slate-100">
                                    <i class="fa-regular fa-clock text-cyan-600"></i>
                                    <span>{{ $item->jam_buka ?? '08:00 - 17:00' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0 flex items-center justify-between">
                            <a href="{{ route('user.destinasi.detail', $item->id) }}" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl text-xs font-semibold transition flex items-center space-x-1.5">
                                <span>Detail & Galeri</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                            <form action="{{ route('user.wishlist.toggle', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-rose-500 hover:bg-rose-50 transition">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-slate-200">
                        <i class="fa-solid fa-map-pin text-4xl text-slate-300 mb-3"></i>
                        <p class="text-sm font-semibold text-slate-600">Tidak ada destinasi ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-4">
                {{ $destinasi->links() }}
            </div>
        </div>
    </main>

</body>
</html>