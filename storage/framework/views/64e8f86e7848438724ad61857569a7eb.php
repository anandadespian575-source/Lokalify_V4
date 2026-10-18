<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi - Lokalify Admin 📍</title>
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
        .input-futuristic:focus { 
            background-color: #ffffff; 
            border-color: #0ea5e9; 
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15); 
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
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full bg-slate-900/60 hover:bg-red-500/20 text-slate-300 hover:text-red-400 py-3 rounded-xl font-bold text-xs transition-all duration-200 flex items-center justify-center gap-2 border border-slate-700/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6 animate__animated animate__fadeInDown">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Edit Destinasi Wisata ✏️</h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Perbarui informasi detail tempat wisata ke database.</p>
                </div>
                <a href="<?php echo e(route('admin.destinasi.index')); ?>" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition">
                    ← Kembali
                </a>
            </div>

            <div class="glass-card rounded-3xl shadow-xl p-8 max-w-4xl mx-auto border border-slate-200 animate__animated animate__fadeInUp">
                <form action="<?php echo e(route('admin.destinasi.update', $destinasi->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Nama Destinasi</label>
                        <input type="text" name="nama_destinasi" value="<?php echo e(old('nama_destinasi', $destinasi->nama_destinasi)); ?>" required 
                            class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic">
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Kategori Wisata</label>
                        <select name="kategori_id" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700 input-futuristic">
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kat->id); ?>" <?php echo e($destinasi->kategori_id == $kat->id ? 'selected' : ''); ?>>
                                    <?php echo e($kat->nama_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Profil Singkat</label>
                            <textarea name="deskripsi_singkat" rows="3" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic resize-none"><?php echo e(old('deskripsi_singkat', $destinasi->deskripsi_singkat)); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Detail Lengkap</label>
                            <textarea name="deskripsi_lengkap" rows="3" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic resize-none"><?php echo e(old('deskripsi_lengkap', $destinasi->deskripsi_lengkap)); ?></textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Ganti Foto Utama (Opsional)</label>
                        <?php if($destinasi->foto): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $destinasi->foto)); ?>" alt="Preview" class="w-20 h-20 object-cover rounded-xl border">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-500">
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                        <input type="text" name="alamat" value="<?php echo e(old('alamat', $destinasi->alamat)); ?>" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic">
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Jam Operasional</label>
                        <input type="text" name="jam_buka" value="<?php echo e(old('jam_buka', $destinasi->jam_buka)); ?>" required class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic">
                    </div>

                    <div>
                        <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-2">Link Google Maps</label>
                        <input type="text" name="link_maps" value="<?php echo e(old('link_maps', $destinasi->link_maps)); ?>" class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800 input-futuristic">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <a href="<?php echo e(route('admin.destinasi.index')); ?>" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 transition">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white px-7 py-2.5 rounded-xl text-xs font-bold shadow-lg shadow-sky-500/25 transition">
                            ✨ Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/admin/destinasi/edit.blade.php ENDPATH**/ ?>