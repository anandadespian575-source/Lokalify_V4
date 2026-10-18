<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Lokalify 📍</title>
    <!-- Tailwind CSS CDN & Font Plus Jakarta Sans -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex text-xs" x-data="{ sidebarOpen: true }">

    <!-- OVERLAY MOBILE -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-30 lg:hidden"></div>

    <!-- SIDEBAR KIRI -->
    <aside 
        class="bg-[#07162d] text-white flex flex-col justify-between p-4 fixed h-screen z-40 transition-all duration-300 ease-in-out border-r border-slate-800 shadow-2xl w-60"
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
                <a href="<?php echo e(route('user.dashboard')); ?>" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fa-solid fa-house text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo e(route('user.wishlist')); ?>" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fa-solid fa-heart text-rose-400 text-sm w-4 text-center"></i>
                    <span>My Wishlist</span>
                </a>
                <a href="<?php echo e(route('user.pengaturan')); ?>" class="flex items-center space-x-3 px-3.5 py-2.5 text-xs font-bold bg-teal-500 text-slate-950 rounded-xl shadow-md shadow-teal-500/20 transition hover:bg-teal-400">
                    <i class="fa-solid fa-gear text-slate-950 text-sm w-4 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>

        <div class="space-y-3 pt-4 border-t border-slate-800/80">
            <div class="flex items-center justify-between px-2 py-1">
                <div class="flex items-center space-x-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-teal-500 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                        <?php echo e(substr(auth()->user()->name ?? 'U', 0, 1)); ?>

                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-white truncate leading-tight"><?php echo e(auth()->user()->name ?? 'Profile'); ?></p>
                        <p class="text-[10px] text-slate-400 truncate">@user</p>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-slate-400 hover:text-rose-400 p-1.5 transition" title="Keluar">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 min-h-screen flex flex-col transition-all duration-300 ease-in-out bg-slate-950" :class="sidebarOpen ? 'lg:ml-60' : 'lg:ml-0'">
        <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 h-16 flex items-center justify-between px-6 sticky top-0 z-20">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl bg-slate-800 text-teal-400 hover:bg-slate-700 transition border border-slate-700">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>
                <h2 class="text-sm font-extrabold text-white tracking-wide">Pengaturan Akun & Bantuan</h2>
            </div>
        </header>

        <!-- KONTEN PENGATURAN -->
        <main class="p-4 lg:p-6 max-w-2xl space-y-5 flex-1 mx-auto w-full">
            
            <?php if(session('success')): ?>
                <div class="bg-teal-500/10 border border-teal-500/30 text-teal-300 px-3 py-2.5 rounded-xl text-[11px] font-semibold flex items-center justify-between">
                    <span><?php echo e(session('success')); ?></span>
                    <i class="fa-solid fa-check"></i>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 px-3 py-2.5 rounded-xl text-[11px] space-y-1">
                    <p class="font-bold">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- KOTAK 1: Informasi Profil & Kata Sandi -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-extrabold text-white">Informasi Profil & Kata Sandi</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Perbarui informasi akun dan ubah kata sandi Anda di sini.</p>
                </div>

                <form action="<?php echo e(route('user.pengaturan.profile')); ?>" method="POST" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition">
                    </div>

                    <div class="pt-3 border-t border-slate-800/80 space-y-3">
                        <h4 class="text-[11px] font-extrabold text-teal-400 uppercase tracking-wider">Ubah Kata Sandi (Opsional)</h4>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Kata Sandi Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah sandi" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-teal-500 transition">
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="px-5 py-2 bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold rounded-xl text-xs transition shadow-md shadow-teal-500/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOTAK 2: Form Laporan Bug dengan Input Upload Foto Bukti Kendala -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-extrabold text-white">🐞 Laporkan Bug / Kendala Sistem</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Temukan masalah atau error? Kirimkan laporan beserta foto bukti kepada pengembang.</p>
                </div>

                <form action="<?php echo e(route('user.pengaturan.bug')); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Upload Bukti Tangkapan Layar / Foto Bug</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-slate-300 file:mr-3 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-slate-800 file:text-teal-400 hover:file:bg-slate-700 transition focus:outline-none">
                        <p class="text-[10px] text-slate-500 mt-1">*Format yang didukung: JPG, JPEG, PNG (Maks. 5MB)</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Detail Pesan / Penjelasan Bug</label>
                        <textarea name="pesan" rows="3" required placeholder="Jelaskan kendala yang Anda alami secara detail..." class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-xs text-white focus:outline-none focus:border-teal-500 transition"></textarea>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="px-5 py-2 bg-rose-500 hover:bg-rose-400 text-white font-extrabold rounded-xl text-xs transition shadow-md shadow-rose-500/20">
                            Kirim Laporan Bug
                        </button>
                    </div>
                </form>
            </div>

            <!-- KOTAK 3: Riwayat Laporan Bug & Jawaban Admin -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-lg space-y-4">
                <div class="border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-extrabold text-white">📋 Riwayat Laporan & Tanggapan Admin</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5">Daftar laporan kendala yang pernah Anda kirim beserta status dan jawabannya.</p>
                </div>

                <div class="space-y-3">
                    <?php $__empty_1 = true; $__currentLoopData = $riwayatLaporan ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-slate-950 border border-slate-800 p-4 rounded-xl space-y-2.5">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-slate-400 font-medium"><?php echo e($lap->created_at->format('d M Y, H:i')); ?></span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold <?php echo e($lap->status == 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'); ?>">
                                    <?php echo e(ucfirst($lap->status)); ?>

                                </span>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-slate-300">Pesan Anda:</p>
                                <p class="text-xs text-slate-200 mt-0.5"><?php echo e($lap->pesan); ?></p>
                            </div>

                            <?php if($lap->foto): ?>
                                <div>
                                    <p class="text-[11px] font-bold text-slate-300 mb-1">Bukti Foto:</p>
                                    <img src="<?php echo e(asset('storage/' . $lap->foto)); ?>" alt="Foto Bukti" class="w-20 h-20 object-cover rounded-lg border border-slate-800">
                                </div>
                            <?php endif; ?>

                            <div class="pt-2 border-t border-slate-800/60">
                                <p class="text-[11px] font-bold text-teal-400">Jawaban Admin:</p>
                                <?php if($lap->jawaban): ?>
                                    <p class="text-xs text-slate-200 mt-0.5 bg-teal-500/5 border border-teal-500/20 p-2.5 rounded-lg"><?php echo e($lap->jawaban); ?></p>
                                <?php else: ?>
                                    <p class="text-xs text-slate-500 italic mt-0.5">Belum ada tanggapan dari admin.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-xs text-slate-500 text-center py-4 italic">Belum ada riwayat laporan yang dikirim.</p>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/user/pengaturan.blade.php ENDPATH**/ ?>