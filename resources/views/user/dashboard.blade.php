<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Lokalify 📍</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* 1. ANIMASI HERO / BERANDA: Fade In + Slide Up Lembut & Santai[cite: 1] */
        @keyframes heroFadeSlideUp {
            0% { opacity: 0; transform: translateY(40px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-hero-entry {
            animation: heroFadeSlideUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes float-parallax-1 {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(20px, -20px) scale(1.05); }
        }
        @keyframes float-parallax-2 {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(-15px, 15px) scale(0.95); }
        }
        .parallax-bg-1 { animation: float-parallax-1 12s ease-in-out infinite; }
        .parallax-bg-2 { animation: float-parallax-2 15s ease-in-out infinite; }

        /* 2. ANIMASI CHAT LOKALIFY: Floating Sangat Ringan[cite: 1] */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-float-ai {
            animation: float-slow 4.5s ease-in-out infinite;
        }

        /* 3. SCROLL REVEAL & STAGGER ANIMATION YANG LEBIH SMOOTH[cite: 1] */
        .reveal-card {
            opacity: 0;
            transform: translateY(35px) scale(0.98);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-card.revealed {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* 4. ANIMASI KELUAR (EXIT ANIMATION) SAAT KLIK DETAIL WISATA (TIDAK SIMPLE) */
        @keyframes complexExit {
            0% { opacity: 1; transform: translateY(0) scale(1) rotate(0deg); filter: blur(0px); }
            40% { opacity: 0.8; transform: translateY(15px) scale(0.99) rotate(0.2deg); filter: blur(1px); }
            100% { opacity: 0; transform: translateY(50px) scale(0.95) rotate(-1deg); filter: blur(8px); }
        }
        .page-exit-animation {
            animation: complexExit 0.85s cubic-bezier(0.7, 0, 0.84, 0) forwards;
            pointer-events: none;
        }

        /* 5. MICROINTERACTION DENGAN FEEDBACK AKTIF[cite: 1] */
        .btn-micro {
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-micro:active {
            transform: scale(0.93) !important;
        }

        /* 6. INDIKATOR MENGETIK AI[cite: 1] */
        @keyframes dotBlink {
            0%, 80%, 100% { opacity: 0.3; transform: scale(0.8); }
            40% { opacity: 1; transform: scale(1.3); }
        }
        .typing-dot {
            animation: dotBlink 1.6s infinite ease-in-out both;
        }
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.25s; }
        .typing-dot:nth-child(3) { animation-delay: 0.5s; }

        .glow-teal {
            box-shadow: 0 0 45px -5px rgba(20, 184, 166, 0.2);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex text-xs selection:bg-teal-500 selection:text-slate-950" 
      x-data="{ sidebarOpen: false, aiOpen: false, isLoading: true, isExiting: false }" 
      x-init="setTimeout(() => isLoading = false, 1000)">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-out duration-400"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-md z-30 lg:hidden"></div>

    <!-- SIDEBAR KIRI -->
    <aside 
        class="bg-[#07162d] text-white flex flex-col justify-between p-4 fixed h-screen z-40 transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] border-r border-slate-800 shadow-2xl w-60"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="space-y-6">
            <div class="flex items-center space-x-3 px-1 py-1">
                <div class="bg-teal-500 p-2 rounded-xl text-slate-950 font-extrabold text-sm flex items-center justify-center shadow-lg shadow-teal-500/20 flex-shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="whitespace-nowrap overflow-hidden">
                    <h1 class="font-extrabold text-sm tracking-wide text-white">Lokalify</h1>
                    <p class="text-[10px] text-teal-400 font-medium">Jelajahi Wisata Lokal</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ route('user.dashboard') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500 text-slate-950 rounded-xl shadow-md shadow-teal-500/20 hover:bg-teal-400">
                    <i class="fa-solid fa-house text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('user.wishlist') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-4 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="{{ route('user.pengaturan') }}" class="btn-micro flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl">
                    <i class="fa-solid fa-gear text-sm w-4 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

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
                    <button type="submit" class="btn-micro text-slate-400 hover:text-rose-400 p-1.5" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER DENGAN KELAS ANIMASI KELUAR -->
    <div class="flex-1 min-h-screen flex flex-col transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] bg-slate-950" 
         :class="{ 'lg:ml-60': sidebarOpen, 'page-exit-animation': isExiting }"
    >
        <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 h-16 flex items-center justify-between px-6 sticky top-0 z-20">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" class="btn-micro p-2 rounded-xl bg-slate-800 text-teal-400 hover:bg-slate-700 border border-slate-700">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>

                <!-- FORM SEARCH DENGAN REKOMENDASI TEKS SAJA -->
                <div class="relative hidden sm:block w-72 md:w-96" 
                     x-data="{ 
                        query: '{{ request('search') }}',
                        items: {{ json_encode($semuaDestinasi ?? []) }},
                        focused: false,
                        get filtered() {
                            if (!this.query.trim()) return [];
                            return this.items.filter(item => 
                                item.nama_destinasi.toLowerCase().includes(this.query.toLowerCase()) ||
                                (item.alamat && item.alamat.toLowerCase().includes(this.query.toLowerCase()))
                            );
                        }
                     }"
                     @click.outside="focused = false"
                >
                    <form action="{{ route('user.dashboard') }}" method="GET" class="relative w-full">
                        <input 
                            type="text" 
                            name="search" 
                            x-model="query"
                            @focus="focused = true"
                            @input="focused = true"
                            placeholder="Cari destinasi..." 
                            class="w-full bg-slate-800/90 border border-slate-700 rounded-2xl pl-4 pr-11 py-2 text-xs text-slate-200 focus:outline-none focus:border-teal-500 transition-all duration-300"
                            autocomplete="off"
                        >
                        <!-- TOMBOL SEARCH DI SEBELAH KANAN -->
                        <button type="submit" class="btn-micro absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-teal-400" title="Cari">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>

                    <!-- REKOMENDASI HANYA TEKS DENGAN TRANSISI HALUS[cite: 1] -->
                    <div x-show="focused && filtered.length > 0" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-3"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-3"
                         class="absolute top-full left-0 right-0 mt-2 bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden z-50 max-h-60 overflow-y-auto"
                    >
                        <div class="p-2.5 text-[10px] text-slate-400 font-bold border-b border-slate-800">
                            Rekomendasi kata kunci untuk "<span x-text="query"></span>":
                        </div>
                        <template x-for="item in filtered" :key="item.id">
                            <a :href="'{{ url('user/destinasi') }}/' + item.id" 
                               @click.prevent="isExiting = true; setTimeout(() => window.location.href = event.currentTarget.href, 750)"
                               class="block px-4 py-2.5 hover:bg-slate-800 transition border-b border-slate-800/50 last:border-none group"
                            >
                                <p class="text-xs font-bold text-white group-hover:text-teal-400 transition" x-text="item.nama_destinasi"></p>
                                <p class="text-[10px] text-teal-400/80 truncate mt-0.5" x-text="item.alamat ?? 'Ciwidey, Bandung'"></p>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button class="btn-micro w-9 h-9 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center border border-slate-700 hover:text-white"><i class="fa-regular fa-bell text-xs"></i></button>
            </div>
        </header>

        <main class="p-6 space-y-6 flex-1 max-w-7xl mx-auto w-full">

            <!-- HERO BANNER SAMBUTAN USER & SOCIAL MEDIA BUTTONS[cite: 1] -->
            <div class="animate-hero-entry relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-[#0a233c] to-slate-900 border border-slate-800/80 p-6 md:p-8 shadow-2xl glow-teal group hover:border-teal-500/40 transition duration-700">
                <div class="parallax-bg-1 absolute -top-12 -right-12 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="parallax-bg-2 absolute -bottom-10 -left-10 w-48 h-48 bg-blue-600/10 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2.5 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 font-bold text-[10px] tracking-wide uppercase">
                            <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                            Ready for Next Adventure?
                        </div>
                        <h1 class="text-xl md:text-2xl font-black text-white tracking-tight leading-tight">
                            Halo, <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-400">{{ auth()->user()->name ?? 'Petualang' }}</span>! 👋
                        </h1>
                        <p class="text-slate-300 text-xs md:text-sm font-medium leading-relaxed">
                            Jangan cuma wacana! Cari udara segar, temukan surga tersembunyi lokal, dan buat momen seru bareng <span class="text-teal-400 font-extrabold">Lokalify</span> hari ini.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2.5 w-full md:w-auto pt-2 md:pt-0 border-t md:border-t-0 border-slate-800/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block md:hidden mb-1">Ikuti Media Sosial Kami:</span>
                        
                        <div class="flex items-center gap-2.5 w-full sm:w-auto">
                            <!-- Tombol TikTok -->
                            <a href="https://www.tiktok.com/@brokolii_047?is_from_webapp=1&sender_device=pc" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-black text-slate-200 hover:text-white border border-slate-700/80 hover:border-teal-400/50 shadow-md hover:shadow-teal-500/20 hover:-translate-y-0.5 group/btn">
                                <i class="fa-brands fa-tiktok text-sm text-cyan-400 group-hover/btn:scale-110 transition duration-300"></i>
                                <span class="font-extrabold text-[11px]">TikTok</span>
                            </a>

                            <!-- Tombol Instagram -->
                            <a href="https://www.instagram.com/hey_nezhh?dlrf=ZWh4ZmxvNW4wbGE2" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-gradient-to-r hover:from-purple-600 hover:to-pink-600 text-slate-200 hover:text-white border border-slate-700/80 hover:border-pink-500/50 shadow-md hover:shadow-pink-500/20 hover:-translate-y-0.5 group/btn">
                                <i class="fa-brands fa-instagram text-sm text-pink-400 group-hover/btn:text-white group-hover/btn:scale-110 transition duration-300"></i>
                                <span class="font-extrabold text-[11px]">Instagram</span>
                            </a>

                            <!-- Tombol YouTube -->
                            <a href="https://youtube.com/@lokalify-s4w?si=lq1zJuPyI18qrqrL" target="_blank" class="btn-micro flex-1 sm:flex-initial flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900/90 hover:bg-rose-600 text-slate-200 hover:text-white border border-slate-700/80 hover:border-rose-500/50 shadow-md hover:shadow-rose-500/20 hover:-translate-y-0.5 group/btn">
                                <i class="fa-brands fa-youtube text-sm text-rose-500 group-hover/btn:text-white group-hover/btn:scale-110 transition duration-300"></i>
                                <span class="font-extrabold text-[11px]">YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION HEADER: DISCOVER DESTINATIONS -->
            <div class="flex justify-between items-center pt-2">
                <h2 class="text-base font-extrabold text-white tracking-tight">Discover Destinations</h2>
                <a href="{{ route('user.dashboard') }}" class="btn-micro text-xs font-bold text-teal-400 hover:underline">Show all</a>
            </div>

            <!-- Kategori Filter -->
            <div class="relative flex items-center w-full" x-data="{
                scrollLeft() { $refs.categoryContainer.scrollBy({ left: -300, behavior: 'smooth' }); },
                scrollRight() { $refs.categoryContainer.scrollBy({ left: 300, behavior: 'smooth' }); }
            }">
                <button @click="scrollLeft()" class="btn-micro flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:bg-teal-500 hover:text-slate-950 flex items-center justify-center shadow-lg mr-2 z-10" title="Geser Kiri">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>

                <div x-ref="categoryContainer" class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar scroll-smooth w-full">
                    <a href="{{ route('user.dashboard') }}" class="btn-micro px-4 py-1.5 rounded-full text-[11px] font-bold whitespace-nowrap {{ !request('kategori') ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-slate-700' }}">Semua Tempat</a>
                    @if(isset($kategori))
                        @foreach ($kategori as $kat)
                            <a href="{{ route('user.dashboard', ['kategori' => $kat->id]) }}" class="btn-micro px-4 py-1.5 rounded-full text-[11px] font-bold whitespace-nowrap {{ request('kategori') == $kat->id ? 'bg-teal-500 text-slate-950 shadow-md shadow-teal-500/20' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-slate-700' }}">{{ $kat->nama_kategori }}</a>
                        @endforeach
                    @endif
                </div>

                <button @click="scrollRight()" class="btn-micro flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:bg-teal-500 hover:text-slate-950 flex items-center justify-center shadow-lg ml-2 z-10" title="Geser Kanan">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>

            <!-- SKELETON LOADING STATE -->
            <div x-show="isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-start">
                <template x-for="i in 4" :key="i">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg animate-pulse">
                        <div class="w-full aspect-video rounded-xl bg-slate-800"></div>
                        <div class="space-y-2">
                            <div class="h-3.5 bg-slate-800 rounded w-3/4"></div>
                            <div class="h-2.5 bg-slate-800 rounded w-1/2"></div>
                            <div class="h-2 bg-slate-800 rounded w-full"></div>
                        </div>
                        <div class="flex items-center justify-between pt-3 border-t border-slate-800/80">
                            <div class="h-3 bg-slate-800 rounded w-12"></div>
                            <div class="h-6 bg-slate-800 rounded w-20"></div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- GRID KARTU DESTINASI (DENGAN SCROLL REVEAL HALUS)[cite: 1] -->
            <div x-show="!isLoading" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 items-start"
            >
                @if(isset($destinasi) && count($destinasi) > 0)
                    @foreach ($destinasi as $index => $item)
                        <div class="reveal-card bg-slate-900 border border-slate-800 rounded-2xl p-3.5 space-y-3 shadow-lg hover:border-teal-500/50 transition duration-500 flex flex-col justify-between h-full group/card"
                             style="transition-delay: {{ $index * 100 }}ms;">
                            
                            <div class="space-y-2.5">
                                <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-slate-950">
                                    @if(!empty($item->foto))
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_destinasi }}" class="w-full h-full object-cover group-hover/card:scale-110 transition duration-900 ease-out">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-teal-500 to-blue-600 flex items-center justify-center text-slate-950 font-bold group-hover/card:scale-110 transition duration-900 ease-out">
                                            <i class="fa-solid fa-mountain-sun text-2xl"></i>
                                        </div>
                                    @endif
                                    <span class="absolute top-2 left-2 bg-slate-950/80 backdrop-blur px-2 py-0.5 rounded-lg text-[9px] font-extrabold text-teal-400 border border-slate-800">
                                        {{ $item->kategori->nama_kategori ?? 'Wisata' }}
                                    </span>
                                </div>

                                <div class="space-y-1">
                                    <h3 class="font-extrabold text-white text-xs group-hover/card:text-teal-400 transition">{{ $item->nama_destinasi }}</h3>
                                    <p class="text-[10px] text-slate-400 flex items-center space-x-1">
                                        <i class="fa-solid fa-location-dot text-teal-400 text-[9px]"></i>
                                        <span>{{ $item->alamat ?? 'Ciwidey, Bandung' }}</span>
                                    </p>

                                    @if($item->deskripsi_singkat)
                                        <p class="text-[10px] text-teal-300/90 mt-1.5 italic leading-relaxed">
                                            "{{ $item->deskripsi_singkat }}"
                                        </p>
                                    @endif
                                </div>
                            </div>

                            @php
                                $totalReviews = $item->reviews ? $item->reviews->count() : 0;
                                $avgRating = $totalReviews > 0 ? round($item->reviews->avg('rating'), 1) : 0;
                            @endphp

                            <div class="flex items-center justify-between pt-3 border-t border-slate-800/80 mt-2">
                                <div class="flex items-center space-x-1 text-amber-400 font-bold text-[10px]">
                                    <i class="fa-solid fa-star text-[9px]"></i>
                                    <span>{{ number_format($avgRating, 1) }}</span>
                                    <span class="text-slate-500 font-normal">({{ $totalReviews }})</span>
                                </div>
                                <!-- TOMBOL DETAIL WISATA DENGAN PANGGILAN ANIMASI KELUAR -->
                                <a href="{{ route('user.destinasi.detail', $item->id) }}" 
                                   @click.prevent="isExiting = true; setTimeout(() => window.location.href = event.currentTarget.href, 750)"
                                   class="btn-micro px-3 py-1 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-lg text-[10px]"
                                >
                                    Detail Wisata ✨
                                </a>
                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="col-span-full py-12 text-center bg-slate-900 rounded-2xl border border-slate-800">
                        <p class="text-xs text-slate-400 font-semibold">Belum ada destinasi wisata di database.</p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- ========================================== -->
    <!-- FLOATING AI GEMINI BUTTON & CHATBOX[cite: 1] -->
    <!-- ========================================== -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

        <!-- CHATBOX POPUP -->
        <div x-show="aiOpen" 
             x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-400 transform"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition cubic-bezier(0.16, 1, 0.3, 1) duration-300 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-10 scale-95"
             class="mb-4 w-80 md:w-96 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden flex flex-col h-[450px] glow-teal"
             style="display: none;"
        >
            <div class="bg-[#07162d] border-b border-slate-800 p-3.5 flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="w-7 h-7 rounded-lg bg-teal-500/20 text-teal-400 flex items-center justify-center font-bold text-xs border border-teal-500/30">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-white text-xs">Lokalify AI Assistant</h4>
                        <p class="text-[9px] text-teal-400">Powered by Denz AI</p>
                    </div>
                </div>
                <button @click="aiOpen = false" class="btn-micro text-slate-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div id="aiChatBox" class="flex-1 p-3.5 overflow-y-auto space-y-3 text-xs no-scrollbar">
                <div class="bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-200 max-w-[85%] leading-relaxed animate-hero-entry">
                    Halo {{ auth()->user()->name ?? 'Petualang' }}! 👋<br>
                    Ada yang ingin kamu tanyakan seputar destinasi wisata, rekomendasi tempat liburan,
                    penginapan, atau mencari tempat wisata terbaik di sekitarmu? 🗺️

                    Lokalify AI siap membantu merencanakan liburanmu! ✨
                </div>
            </div>

            <div class="p-3 border-t border-slate-800 bg-slate-900/90">
                <form id="aiChatForm" class="flex items-center gap-2" onsubmit="handleSendAiMessage(event)">
                    <input 
                        type="text" 
                        id="aiInput" 
                        placeholder="Tanyakan sesuatu..." 
                        class="flex-1 bg-slate-800 border border-slate-700 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition-all"
                        required
                    >
                    <button type="submit" id="aiSendBtn" class="btn-micro bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold px-3 py-2 rounded-xl text-xs flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- FLOATING BUTTON -->
        <button 
            @click="aiOpen = !aiOpen"
            class="animate-float-ai btn-micro flex items-center gap-2.5 px-4 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-slate-950 font-extrabold rounded-full shadow-2xl shadow-teal-500/30 transition transform hover:scale-105"
            title="Tanya AI Lokalify"
        >
            <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
            <span class="text-xs tracking-wide">Tanya AI</span>
        </button>
    </div>

    <!-- JAVASCRIPT INTEGRASI AI & INTERSECTION OBSERVER[cite: 1] -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-card').forEach(el => observer.observe(el));
        });

        let chatHistory = [];

        async function handleSendAiMessage(event) {
            event.preventDefault();

            const inputEl = document.getElementById('aiInput');
            const chatBox = document.getElementById('aiChatBox');
            const sendBtn = document.getElementById('aiSendBtn');
            const userMessage = inputEl.value.trim();

            if (!userMessage || sendBtn.disabled) return;

            const userBubble = document.createElement('div');
            userBubble.className = 'flex justify-end animate-hero-entry';
            const userText = document.createElement('div');
            userText.className = 'bg-teal-500 text-slate-950 font-medium rounded-xl p-3 max-w-[85%] leading-relaxed';
            userText.textContent = userMessage;
            userBubble.appendChild(userText);
            chatBox.appendChild(userBubble);

            inputEl.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            const loadingEl = document.createElement('div');
            loadingEl.className = 'bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-400 max-w-[85%] flex items-center gap-2 animate-hero-entry';
            loadingEl.innerHTML = `
                <span class="text-xs text-teal-400 font-semibold mr-1">Lokalify AI</span>
                <div class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                    <span class="w-1.5 h-1.5 bg-teal-400 rounded-full typing-dot"></span>
                </div>
            `;
            chatBox.appendChild(loadingEl);
            chatBox.scrollTop = chatBox.scrollHeight;
            sendBtn.disabled = true;
            sendBtn.classList.add('opacity-60', 'cursor-not-allowed');

            try {
                const response = await fetch(@json(route('user.ai.chat')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token())
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        message: userMessage,
                        history: chatHistory
                    })
                });

                const data = await response.json().catch(() => ({}));
                loadingEl.remove();

                if (!response.ok) {
                    throw new Error(data.message || 'AI belum dapat menjawab. Periksa konfigurasi Gemini di server.');
                }

                const aiReply = data.reply || 'Maaf, AI belum memberikan jawaban. Silakan coba lagi.';

                chatHistory.push({ role: 'user', text: userMessage });
                chatHistory.push({ role: 'model', text: aiReply });

                const replyEl = document.createElement('div');
                replyEl.className = 'bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 text-slate-200 max-w-[85%] leading-relaxed animate-hero-entry';
                replyEl.textContent = aiReply;
                replyEl.style.whiteSpace = 'pre-wrap';
                chatBox.appendChild(replyEl);
            } catch (error) {
                if (loadingEl.isConnected) loadingEl.remove();
                const errorEl = document.createElement('div');
                errorEl.className = 'bg-rose-950/50 border border-rose-800/50 rounded-xl p-3 text-rose-300 max-w-[85%] animate-hero-entry';
                errorEl.textContent = error.message || 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                chatBox.appendChild(errorEl);
                console.error('Lokalify AI request failed:', error);
            } finally {
                sendBtn.disabled = false;
                sendBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                chatBox.scrollTop = chatBox.scrollHeight;
                inputEl.focus();
            }
        }
    </script>
</body>
</html>