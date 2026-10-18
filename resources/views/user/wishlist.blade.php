<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Lokalify 📍</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk toggle sidebar -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex text-xs" x-data="{ sidebarOpen: true }">

    <!-- OVERLAY MOBILE -->
    <div 
        x-show="sidebarOpen" 
        @click="sidebarOpen = false" 
        class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-30 lg:hidden"
    ></div>

    <!-- SIDEBAR KIRI (Tersembunyi total saat ditutup) -->
    <aside 
        class="bg-[#07162d] text-white flex flex-col justify-between p-4 fixed h-screen z-40 transition-all duration-300 ease-in-out border-r border-slate-800 shadow-2xl w-60"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="space-y-6">
            <!-- Logo Brand -->
            <div class="flex items-center space-x-3 px-1 py-1">
                <div class="bg-teal-500 p-2 rounded-xl text-slate-950 font-extrabold text-sm flex items-center justify-center shadow-lg shadow-teal-500/20 flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="whitespace-nowrap overflow-hidden">
                    <h1 class="font-extrabold text-sm tracking-wide text-white">Lokalify</h1>
                    <p class="text-[10px] text-teal-400 font-medium">Jelajahi Wisata Lokal</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fa-solid fa-house text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('user.wishlist') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500 text-slate-950 rounded-xl shadow-md shadow-teal-500/20 transition hover:bg-teal-400">
                    <i class="fa-solid fa-heart text-slate-950 text-sm w-4 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fa-solid fa-gear text-sm w-4 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <!-- Bagian Bawah Sidebar -->
        <div class="space-y-3 pt-4 border-t border-slate-800/80">
            <div class="flex items-center justify-between px-2 py-1">
                <div class="flex items-center space-x-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-teal-500 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-white truncate leading-tight">{{ auth()->user()->name ?? 'Profile' }}</p>
                        <p class="text-[10px] text-slate-400 truncate">@user</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-rose-400 p-1.5 transition" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-h-screen flex flex-col transition-all duration-300 ease-in-out bg-slate-950" :class="sidebarOpen ? 'lg:ml-60' : 'lg:ml-0'">
        <!-- TOP NAVBAR (Tanpa Lonceng) -->
        <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 h-16 flex items-center justify-between px-6 sticky top-0 z-20">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl bg-slate-800 text-teal-400 hover:bg-slate-700 transition border border-slate-700 focus:outline-none">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>
                <h2 class="text-sm font-extrabold text-white tracking-wide">My Wishlist Destinations</h2>
            </div>
        </header>

        <!-- KONTEN UTAMA WISHLIST -->
        <main class="p-5 lg:p-6 space-y-6 flex-1 flex flex-col justify-center">
            
            <!-- Notifikasi Flash Message -->
            @if(session('success'))
                <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 px-4 py-3 rounded-xl text-xs font-semibold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <i class="fa-solid fa-check"></i>
                </div>
            @endif

            <!-- Grid Destinasi Wishlist -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($wishlists as $wish)
                    @if($wish->destinasi)
                        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 space-y-3 shadow-lg hover:border-teal-500/50 transition flex flex-col justify-between">
                            <div>
                                <!-- Foto Destinasi -->
                                <div class="relative w-full h-48 rounded-xl overflow-hidden bg-slate-950">
                                    @if($wish->destinasi->foto)
                                        <img src="{{ asset('storage/' . $wish->destinasi->foto) }}" alt="{{ $wish->destinasi->nama_destinasi }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-teal-500 to-blue-600 flex items-center justify-center text-slate-950 font-bold">
                                            <i class="fa-solid fa-mountain-sun text-2xl"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Tombol Hapus dari Wishlist (Toggle) -->
                                    <form action="{{ route('user.wishlist.toggle', $wish->destinasi->id) }}" method="POST" class="absolute top-2.5 right-2.5">
                                        @csrf
                                        <button type="submit" class="w-8 h-8 rounded-full bg-slate-950/80 backdrop-blur text-rose-500 hover:scale-110 flex items-center justify-center transition shadow border border-slate-800" title="Hapus dari Wishlist">
                                            <i class="fa-solid fa-heart text-xs"></i>
                                        </button>
                                    </form>

                                    <span class="absolute top-2.5 left-2.5 bg-slate-950/80 backdrop-blur px-2.5 py-1 rounded-lg text-[10px] font-extrabold text-teal-400 border border-slate-800">
                                        Saved Places
                                    </span>
                                </div>

                                <!-- Informasi -->
                                <div class="pt-3 space-y-1">
                                    <h3 class="font-extrabold text-white text-xs truncate">{{ $wish->destinasi->nama_destinasi }}</h3>
                                    <p class="text-[11px] text-slate-400 flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot text-teal-400 text-[10px]"></i>
                                        <span class="truncate">{{ $wish->destinasi->alamat ?? 'Ciwidey, Bandung' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Kartu -->
                            <div class="flex items-center justify-between pt-2 border-t border-slate-800">
                                <span class="text-[11px] text-slate-500 font-medium">Tersimpan di Wishlist</span>
                                <a href="{{ route('user.destinasi.detail', $wish->destinasi->id) }}" class="px-3.5 py-1.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-[11px] transition">
                                    Detail Wisata →
                                </a>
                            </div>
                        </div>
                    @endif
                @empty
                    <!-- TAMPILAN KOSONG YANG MENARIK DENGAN EMOJI LOVE PATAH HATI -->
                    <div class="col-span-full flex flex-col items-center justify-center py-20 px-4 text-center bg-slate-900/60 backdrop-blur-md rounded-3xl border border-slate-800 space-y-4 max-w-lg mx-auto w-full shadow-2xl">
                        <div class="w-16 h-16 rounded-2xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-3xl shadow-lg">
                            💔
                        </div>
                        <div class="space-y-1 max-w-sm">
                            <h3 class="text-sm font-extrabold text-white tracking-wide">Wishlist Anda Masih Kosong</h3>
                            <p class="text-[11px] text-slate-400 leading-relaxed">Belum ada destinasi wisata menarik yang Anda simpan. Yuk, mulai jelajahi berbagai tempat wisata seru di Lokalify!</p>
                        </div>
                        <a href="{{ route('user.dashboard') }}" class="px-5 py-2.5 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs transition shadow-lg shadow-teal-500/20 flex items-center space-x-2">
                            <i class="fa-solid fa-compass text-sm"></i>
                            <span>Jelajahi Destinasi Sekarang</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>