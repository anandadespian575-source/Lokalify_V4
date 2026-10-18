<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateAdminLayout extends Command
{
    protected $signature = 'admin:make-layout';
    protected $description = 'Membuat file layout admin utama (admin.blade.php) secara otomatis';

    public function handle()
    {
        $path = resource_path('views/layouts/admin.blade.php');

        // Pastikan folder layouts sudah ada
        if (!File::isDirectory(resource_path('views/layouts'))) {
            File::makeDirectory(resource_path('views/layouts'), 0755, true);
        }

        // Isi kode layout lengkap
        $content = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Lokalify')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- SCRIPT OTOMATIS: Mengecek tema gelap/terang di seluruh halaman -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(51, 65, 85, 0.8);
        }
        .sidebar-gradient { background: linear-gradient(180deg, #091a2f 0%, #032b56 100%); }
    </style>
</head>
<body class="bg-[#f0f4f9] dark:bg-slate-950 flex min-h-screen text-slate-800 dark:text-slate-100 transition-colors duration-300">

    <!-- Sidebar Navigasi Admin -->
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
                <a href="/admin/dashboard" class="flex items-center gap-3.5 py-3 px-4 rounded-xl {{ request()->is('admin/dashboard') ? 'bg-sky-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10' }}">Dashboard</a>
                <a href="/admin/destinasi" class="flex items-center gap-3.5 py-3 px-4 rounded-xl {{ request()->is('admin/destinasi*') ? 'bg-sky-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10' }}">Kelola Destinasi</a>
                <a href="/admin/kategori" class="flex items-center gap-3.5 py-3 px-4 rounded-xl {{ request()->is('admin/kategori*') ? 'bg-sky-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10' }}">Kategori</a>
                <a href="/admin/laporan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl {{ request()->is('admin/laporan*') ? 'bg-sky-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10' }}">Laporan User</a>
                <a href="/admin/pengaturan" class="flex items-center gap-3.5 py-3 px-4 rounded-xl {{ request()->is('admin/pengaturan*') ? 'bg-sky-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/10' }}">Pengaturan</a>
            </nav>
        </div>
        <div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full bg-slate-900/60 hover:bg-red-500/20 text-slate-300 hover:text-red-400 py-3 rounded-xl font-bold text-xs transition flex items-center justify-center gap-2 border border-slate-700/50">
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 px-8 py-3.5 flex justify-between items-center sticky top-0 z-50">
            <div class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Panel Administrator Lokalify</div>
            <div class="flex items-center gap-3">
                <button onclick="toggleTheme()" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-yellow-400 transition" title="Ubah Tema">
                    🌙
                </button>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function toggleTheme() {
            const body = document.documentElement;
            body.classList.toggle('dark');
            localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>
</body>
</html>
HTML;

        File::put($path, $content);
        $this->info('File layout admin.blade.php berhasil dibuat secara otomatis di resources/views/layouts/admin.blade.php!');
    }
}