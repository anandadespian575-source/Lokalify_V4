<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulasan & Foto - Lokalify Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(226, 232, 240, 0.8); }
        .sidebar-gradient { background: linear-gradient(180deg, #091a2f 0%, #032b56 100%); }
    </style>
</head>
<body class="bg-[#f0f4f9] flex min-h-screen text-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 sidebar-gradient text-white p-5 flex flex-col justify-between hidden md:flex shrink-0 shadow-xl border-r border-slate-800/50">
        <div>
            <div class="flex items-center gap-3 mb-8 px-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-xl shadow-lg">🏔️</div>
                <div>
                    <h1 class="text-xl font-black text-white tracking-tight">Lokalify</h1>
                    <p class="text-[10px] text-sky-300 font-medium">Jelajahi Ciwidey, Temukan Cerita</p>
                </div>
            </div>
            <nav class="space-y-1.5 text-sm font-semibold">
                <a href="/admin/dashboard" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10">Dashboard</a>
                <a href="/admin/destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10">Kelola Destinasi</a>
                <a href="/admin/kategori" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10">Kategori</a>
                <a href="/admin/laporan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10">Laporan User</a>
                <a href="/admin/pengaturan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl text-slate-300 hover:bg-white/10">Pengaturan</a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-8">
        <div class="flex justify-between items-center mb-6 animate__animated animate__fadeInDown">
            <div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Daftar Ulasan Wisatawan ⭐</h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Ulasan lengkap beserta rating, komentar, dan foto ulasan dari user.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate__animated animate__fadeInUp">
            @forelse($reviews as $rev)
            <div class="glass-card rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col justify-between">
                <div>
                    <!-- Header Ulasan -->
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">{{ $rev->user->name ?? 'Anonim' }}</h4>
                            <p class="text-[11px] text-sky-600 font-semibold mt-0.5">📍 {{ $rev->destinasi->nama_destinasi ?? 'Destinasi Dihapus' }}</p>
                        </div>
                        <span class="bg-amber-50 text-amber-600 border border-amber-200/60 px-2.5 py-1 rounded-full text-xs font-bold">
                            ⭐ {{ $rev->rating ?? 5 }}/5
                        </span>
                    </div>

                    <!-- Komentar Review -->
                    <p class="text-xs text-slate-600 bg-slate-50 p-3.5 rounded-2xl border border-slate-100 mb-4 leading-relaxed">
                        "{{ $rev->review ?? $rev->komentar ?? '-' }}"
                    </p>

                    <!-- Foto Ulasan dari User (Jika diunggah) -->
                    @if(!empty($rev->foto))
                        <div class="mb-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Foto Lampiran Ulasan:</p>
                            <div class="w-full h-40 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100">
                                <img src="{{ asset('storage/' . $rev->foto) }}" alt="Foto Ulasan" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer Waktu Ulasan -->
                <div class="border-t border-slate-100 pt-3 flex justify-between items-center text-[10px] text-slate-400">
                    <span>{{ $rev->created_at->format('d M Y, H:i') }}</span>
                    <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full font-bold">Valid</span>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 glass-card rounded-3xl border border-slate-200">
                <p class="text-slate-400 text-xs font-medium">Belum ada ulasan yang dikirimkan oleh user.</p>
            </div>
            @endforelse
        </div>
    </main>
</body>
</html>