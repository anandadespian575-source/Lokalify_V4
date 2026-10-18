<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($destinasi->nama_destinasi); ?> - Detail Destinasi 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* =========================================================
           01. HALAMAN MULAI TERBUKA (0–200 ms): Fade In + Slide Up[cite: 3]
           05. PENGGUNA KEMBALI (220–300 ms): Fade Out + Slide Down[cite: 3]
           ========================================================= */
        @keyframes pageEntry {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes pageExit {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }
        .anim-page-entry {
            animation: pageEntry 200ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .anim-page-exit {
            animation: pageExit 250ms cubic-bezier(0.7, 0, 0.84, 0) forwards !important;
        }

        /* =========================================================
           02. FOTO DESTINASI TAMPIL (100–700 ms): Hero Zoom[cite: 3]
           ========================================================= */
        @keyframes heroZoom {
            0% { transform: scale(1.15); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        .anim-hero-zoom {
            animation: heroZoom 600ms cubic-bezier(0.16, 1, 0.3, 1) 100ms forwards;
            will-change: transform, opacity;
        }

        /* =========================================================
           03. INFORMASI WISATA MENYUSUL (150–800 ms): Stagger Reveal[cite: 3]
           ========================================================= */
        @keyframes staggerItem {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-stagger-1 { animation: staggerItem 400ms ease-out 150ms forwards; opacity: 0; }
        .anim-stagger-2 { animation: staggerItem 400ms ease-out 300ms forwards; opacity: 0; }
        .anim-stagger-3 { animation: staggerItem 400ms ease-out 450ms forwards; opacity: 0; }

        /* =========================================================
           04. GALERI DAN ULASAN (Saat Terlihat): Scroll Reveal[cite: 3]
           ========================================================= */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 500ms ease-out, transform 500ms ease-out;
            will-change: opacity, transform;
        }
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4 text-xs">

    <!-- Container Utama dengan Animasi Page Entry & Exit[cite: 3] -->
    <div id="mainCard" class="anim-page-entry bg-slate-900 border border-slate-800 w-full max-w-2xl rounded-3xl overflow-hidden shadow-2xl relative space-y-5 p-6 md:p-8 my-6">
        
        <!-- Notifikasi Sukses -->
        <?php if(session('success')): ?>
            <div class="bg-teal-500/10 border border-teal-500/30 text-teal-400 p-3 rounded-xl text-xs flex items-center space-x-2">
                <i class="fa-solid fa-circle-check"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <!-- Notifikasi Error Validasi -->
        <?php if($errors->any()): ?>
            <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 p-3 rounded-xl text-xs space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="flex items-center space-x-1">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span><?php echo e($error); ?></span>
                    </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <!-- Tombol Kembali & Tombol Lapor Destinasi (Pengguna kembali: Fade Out + Slide Down 220–300 ms)[cite: 3] -->
        <div class="absolute top-5 right-5 flex items-center space-x-2 z-10">
            <button onclick="openReportModal()" class="h-8 px-3 rounded-full bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 flex items-center space-x-1 transition border border-rose-500/30 text-[11px] font-semibold" title="Laporkan Destinasi">
                <i class="fa-solid fa-flag text-xs"></i>
                <span>Lapor</span>
            </button>
            <a href="<?php echo e(route('user.dashboard')); ?>" onclick="handleBackWithAnimation(event, this.href)" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition border border-slate-700" title="Kembali">
                <i class="fa-solid fa-xmark text-xs"></i>
            </a>
        </div>

        <!-- 02. Foto Utama (Hero Zoom 100–700 ms) & Tombol Wishlist[cite: 3] -->
        <div class="relative w-full h-64 rounded-2xl overflow-hidden bg-slate-950 border border-slate-800">
            <?php if($destinasi->foto): ?>
                <img src="<?php echo e(asset('storage/' . $destinasi->foto)); ?>" alt="<?php echo e($destinasi->nama_destinasi); ?>" class="anim-hero-zoom w-full h-full object-cover">
            <?php else: ?>
                <div class="flex items-center justify-center h-full text-6xl anim-hero-zoom">🏝️</div>
            <?php endif; ?>
            
            <span class="absolute top-3 left-3 bg-slate-950/80 backdrop-blur px-3 py-1 rounded-xl text-xs font-bold text-teal-400 border border-slate-800 z-10">
                <?php echo e($destinasi->kategori->nama_kategori ?? 'Wisata'); ?>

            </span>

            <form action="<?php echo e(route('user.wishlist.toggle', $destinasi->id)); ?>" method="POST" class="absolute top-3 right-3 z-10">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-9 h-9 rounded-xl bg-slate-950/80 backdrop-blur border border-slate-800 flex items-center justify-center transition shadow-lg group" title="Wishlist">
                    <?php if(isset($isWishlist) &&$isWishlist): ?>
                        <i class="fa-solid fa-heart text-rose-500 text-sm scale-110 transition"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-heart text-slate-300 group-hover:text-rose-400 text-sm transition"></i>
                    <?php endif; ?>
                </button>
            </form>
        </div>

        <!-- 03. Informasi Wisata Menyusul: Stagger Reveal (150–800 ms)[cite: 3] -->
        <!-- Nama Destinasi, Alamat & Jam Operasional (Stagger 1)[cite: 3] -->
        <div class="anim-stagger-1 space-y-1.5">
            <h2 class="text-xl font-extrabold text-white"><?php echo e($destinasi->nama_destinasi); ?></h2>
            <p class="text-xs text-teal-400 font-medium flex items-center space-x-1">
                <i class="fa-solid fa-location-dot"></i>
                <span><?php echo e($destinasi->alamat ?? 'Lokasi tidak tersedia'); ?></span>
            </p>
            <?php if($destinasi->jam_buka): ?>
                <p class="text-[11px] text-slate-400 flex items-center space-x-1">
                    <i class="fa-regular fa-clock text-teal-400"></i>
                    <span>Jam Operasional: <?php echo e($destinasi->jam_buka); ?></span>
                </p>
            <?php endif; ?>
        </div>

        <!-- Profil Singkat / Highlight (Stagger 2)[cite: 3] -->
        <?php if($destinasi->deskripsi_singkat): ?>
            <div class="anim-stagger-2 bg-teal-500/10 border border-teal-500/20 p-3.5 rounded-2xl space-y-1">
                <h4 class="font-bold text-teal-300 text-xs uppercase">Highlight / Profil Singkat</h4>
                <p class="text-xs text-slate-300"><?php echo e($destinasi->deskripsi_singkat); ?></p>
            </div>
        <?php endif; ?>

        <!-- Detail Lengkap & Fasilitas (Stagger 3)[cite: 3] -->
        <div class="anim-stagger-3 space-y-1.5 bg-slate-950/50 p-4 rounded-2xl border border-slate-800">
            <h3 class="font-extrabold text-slate-200 text-xs uppercase tracking-wider">Detail Lengkap & Fasilitas</h3>
            <p class="text-xs text-slate-400 leading-relaxed font-normal whitespace-pre-line">
                <?php echo e($destinasi->deskripsi_lengkap ?? $destinasi->deskripsi ?? 'Belum ada detail penjelasan.'); ?>

            </p>
        </div>

        <!-- ==================== 04. GALERI FOTO & VIDEO (Scroll Reveal saat terlihat) ====================[cite: 3] -->
        <?php
            $galeriItems =$destinasi->galeri ?? collect();
        ?>
        <div class="scroll-reveal space-y-3 pt-2">
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="font-extrabold text-white text-xs flex items-center space-x-1.5">
                    <i class="fa-solid fa-images text-teal-400"></i>
                    <span>Galeri Wisatawan</span>
                </h3>
                <span class="text-[10px] text-slate-400">Foto & Video dari Pengguna</span>
            </div>

            <!-- Display Grid Galeri -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 max-h-64 overflow-y-auto no-scrollbar">
                <?php $__empty_1 = true; $__currentLoopData = $galeriItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div onclick="openMediaModal(<?php echo e($index); ?>)" 
                         class="relative group rounded-xl overflow-hidden bg-slate-950 border border-slate-800 h-28 cursor-pointer">
                        <?php if($g->jenis == 'foto'): ?>
                            <img src="<?php echo e(asset('storage/' . $g->file_path)); ?>" alt="Foto Galeri" class="w-full h-full object-cover transition transform group-hover:scale-105">
                        <?php else: ?>
                            <video class="w-full h-full object-cover pointer-events-none">
                                <source src="<?php echo e(asset('storage/' . $g->file_path)); ?>" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-950/40 group-hover:bg-slate-950/20 transition">
                                <i class="fa-solid fa-play text-white text-lg drop-shadow-md"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute inset-0 bg-teal-500/10 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <i class="fa-solid fa-magnifying-glass-plus text-white text-sm"></i>
                        </div>

                        <div class="absolute bottom-1 left-1 bg-slate-950/80 backdrop-blur px-2 py-0.5 rounded-md text-[9px] text-teal-300 border border-slate-800">
                            👤 <?php echo e($g->user->name ?? 'User'); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full py-4 text-center bg-slate-950/50 rounded-xl border border-slate-800/50">
                        <p class="text-xs text-slate-500 italic">Belum ada foto atau video di galeri ini. Jadilah yang pertama mengunggah!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Form Upload Galeri Baru -->
            <div class="bg-slate-950/80 p-3.5 rounded-2xl border border-slate-800 space-y-2">
                <h4 class="font-bold text-white text-xs flex items-center space-x-1">
                    <i class="fa-solid fa-cloud-arrow-up text-teal-400"></i>
                    <span>Tambah Foto / Video Kamu</span>
                </h4>
                <form action="<?php echo e(route('user.galeri.store', $destinasi->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-2.5">
                    <?php echo csrf_field(); ?>
                    <div>
                        <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4,video/mov,video/avi" required class="block w-full text-[11px] text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-teal-500 file:text-slate-950 hover:file:bg-teal-400 cursor-pointer bg-slate-900 border border-slate-800 rounded-xl">
                        <p class="text-[10px] text-slate-500 mt-1">Maksimal ukuran: <b>Foto 5MB</b> | <b>Video 30MB</b></p>
                    </div>
                    <button type="submit" class="w-full py-2 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-xl text-xs transition shadow-md shadow-teal-500/10">
                        Unggah Ke Galeri
                    </button>
                </form>
            </div>
        </div>
        <!-- ============================================================= -->

        <!-- 04. Section Ulasan Pengguna & Ringkasan Rating (Scroll Reveal saat terlihat)[cite: 3] -->
        <?php
            $reviewItems =$destinasi->reviews ?? collect();
            $totalReviews = $reviewItems->count();$avgRating = $totalReviews > 0 ? round($reviewItems->avg('rating'), 1) : 0;
            $ratingPercentage = round(($avgRating / 5) * 100);
        ?>

        <div class="scroll-reveal space-y-3 pt-2">
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="font-extrabold text-white text-xs">User Reviews</h3>
                <div class="text-amber-400 font-bold text-xs flex items-center space-x-1">
                    <i class="fa-solid fa-star text-amber-400"></i>
                    <span><?php echo e(number_format($avgRating, 1)); ?> / 5.0 (<?php echo e($ratingPercentage); ?>%)</span>
                </div>
            </div>
            
            <div class="space-y-2.5 max-h-48 overflow-y-auto no-scrollbar">
                <?php $__empty_1 = true; $__currentLoopData = $reviewItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-slate-950 p-3.5 rounded-xl border border-slate-800 flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-teal-500 text-slate-950 font-black flex items-center justify-center text-xs flex-shrink-0">
                            <?php echo e(substr($rev->user->name ?? 'U', 0, 1)); ?>

                        </div>
                        <div class="space-y-1 flex-1">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-white text-xs"><?php echo e($rev->user->name ?? 'Pengguna'); ?></span>
                                <div class="text-amber-400 text-[10px]">
                                    <?php for($i = 0; $i < $rev->rating; $i++): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed"><?php echo e($rev->komentar); ?></p>
                            <?php if($rev->foto): ?>
                                <img src="<?php echo e(asset('storage/' . $rev->foto)); ?>" class="w-20 h-20 object-cover rounded-lg border border-slate-800 mt-2">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-xs text-slate-500 italic text-center py-2">Belum ada ulasan untuk destinasi ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Form Tambah Ulasan Baru (Scroll Reveal)[cite: 3] -->
        <div class="scroll-reveal bg-slate-950/80 p-4 rounded-2xl border border-slate-800 space-y-3">
            <h4 class="font-bold text-white text-xs">➕ Beri Ulasan Kamu</h4>
            <form action="<?php echo e(route('user.review.store', $destinasi->id)); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Rating Bintang:</label>
                    <select name="rating" class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-teal-500">
                        <option value="5">⭐⭐⭐⭐⭐ 5 Star</option>
                        <option value="4">⭐⭐⭐⭐ 4 Star</option>
                        <option value="3">⭐⭐⭐ 3 Star</option>
                        <option value="2">⭐⭐ 2 Star</option>
                        <option value="1">⭐ 1 Star</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Komentar / Pengalaman:</label>
                    <textarea name="komentar" rows="2" required placeholder="Tuliskan ulasan kamu..." class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl p-3 text-xs focus:outline-none focus:border-teal-500"></textarea>
                </div>
                <button type="submit" class="w-full py-2 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-xl text-xs transition">
                    Kirim Ulasan
                </button>
            </form>
        </div>

        <!-- Tombol Buka Maps (Scroll Reveal)[cite: 3] -->
        <?php if($destinasi->link_maps): ?>
            <div class="scroll-reveal pt-1">
                <a href="<?php echo e($destinasi->link_maps); ?>" target="_blank" class="block w-full text-center py-3 bg-teal-500 hover:bg-teal-400 text-slate-950 font-black rounded-2xl text-xs transition shadow-lg shadow-teal-500/20">
                    Buka Google Maps / Lokasi 🗺️
                </a>
            </div>
        <?php endif; ?>

    </div>

    <!-- Modal Form Lapor Destinasi -->
    <div id="reportModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md rounded-3xl p-6 space-y-4 shadow-2xl relative">
            <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                <h3 class="font-extrabold text-white text-sm flex items-center space-x-2">
                    <i class="fa-solid fa-flag text-rose-500"></i>
                    <span>Laporkan Destinasi Ini</span>
                </h3>
                <button onclick="closeReportModal()" class="w-7 h-7 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            <form action="<?php echo e(route('user.destinasi.report', $destinasi->id)); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Alasan Pelaporan:</label>
                    <select name="alasan" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2.5 text-xs focus:outline-none focus:border-rose-500">
                        <option value="" disabled selected>Pilih alasan laporan...</option>
                        <option value="Informasi / Alamat Palsu">Informasi / Alamat Palsu</option>
                        <option value="Destinasi Sudah Tutup / Permanen">Destinasi Sudah Tutup / Permanen</option>
                        <option value="Konten / Foto Tidak Pantas">Konten / Foto Tidak Pantas</option>
                        <option value="Duplikat Destinasi">Duplikat Destinasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Keterangan Tambahan:</label>
                    <textarea name="keterangan" rows="3" required placeholder="Jelaskan detail masalah pada destinasi ini..." class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl p-3 text-xs focus:outline-none focus:border-rose-500"></textarea>
                </div>
                <div class="flex space-x-2 pt-2">
                    <button type="button" onclick="closeReportModal()" class="w-1/2 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-xl text-xs transition">
                        Batal
                    </button>
                    <button type="submit" class="w-1/2 py-2.5 bg-rose-500 hover:bg-rose-400 text-white font-bold rounded-xl text-xs transition shadow-lg shadow-rose-500/20">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Popup Preview Media (Foto/Video) Dengan Slider Navigasi -->
    <div id="mediaModal" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-50 hidden items-center justify-center p-4">
        <div class="relative max-w-4xl w-full flex flex-col items-center justify-center space-y-3">
            
            <button onclick="closeMediaModal()" class="absolute -top-10 right-0 w-9 h-9 rounded-full bg-slate-800/80 hover:bg-slate-700 text-white flex items-center justify-center transition border border-slate-700 z-20">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <button id="btnPrev" onclick="prevMedia()" class="absolute left-2 md:-left-12 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-800/80 hover:bg-slate-700 text-white flex items-center justify-center transition border border-slate-700 shadow-xl z-20">
                <i class="fa-solid fa-chevron-left text-base"></i>
            </button>

            <button id="btnNext" onclick="nextMedia()" class="absolute right-2 md:-right-12 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-800/80 hover:bg-slate-700 text-white flex items-center justify-center transition border border-slate-700 shadow-xl z-20">
                <i class="fa-solid fa-chevron-right text-base"></i>
            </button>

            <div class="w-full flex items-center justify-center max-h-[80vh] overflow-hidden rounded-2xl border border-slate-800 bg-slate-900 shadow-2xl relative">
                <img id="modalImage" src="" class="hidden max-h-[80vh] w-auto object-contain rounded-2xl">
                <video id="modalVideo" controls class="hidden max-h-[80vh] w-auto rounded-2xl">
                    <source id="modalVideoSource" src="" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>

            <div class="flex items-center space-x-2 text-xs text-slate-300 bg-slate-900/80 px-4 py-1.5 rounded-full border border-slate-800 font-semibold">
                <span>Diunggah oleh: <b id="uploaderName" class="text-teal-400"></b></span>
                <span class="text-slate-600">|</span>
                <span id="mediaCounter" class="text-slate-400"></span>
            </div>
        </div>
    </div>

    <!-- Script JavaScript Slider Gallery & Interactivity Observer[cite: 3] -->
    <script>
        // 04. Scroll Reveal Observer untuk Galeri & Ulasan saat terlihat[cite: 3]
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

            document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
        });

        // 05. Pengguna kembali: Fade Out + Slide Down (220–300 ms)[cite: 3]
        function handleBackWithAnimation(e, targetUrl) {
            e.preventDefault();
            const mainCard = document.getElementById('mainCard');
            if (mainCard) {
                mainCard.classList.add('anim-page-exit');
                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 250);
            } else {
                window.location.href = targetUrl;
            }
        }

        const galeriRaw = <?php echo json_encode($galeriItems, 15, 512) ?>;
        
        const galeriItems = galeriRaw.map(item => ({
            url: "<?php echo e(asset('storage')); ?>/" + item.file_path,
            type: item.jenis,
            user: item.user ? item.user.name : 'User'
        }));

        let currentIndex = 0;

        function openReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function openMediaModal(index) {
            if (galeriItems.length === 0) return;
            currentIndex = index;
            updateMediaDisplay();

            const modal = document.getElementById('mediaModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeMediaModal() {
            const modal = document.getElementById('mediaModal');
            const modalVid = document.getElementById('modalVideo');
            if (modalVid) modalVid.pause();
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function updateMediaDisplay() {
            const currentItem = galeriItems[currentIndex];
            const modalImg = document.getElementById('modalImage');
            const modalVid = document.getElementById('modalVideo');
            const modalVidSrc = document.getElementById('modalVideoSource');
            const uploaderName = document.getElementById('uploaderName');
            const counter = document.getElementById('mediaCounter');

            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');

            uploaderName.innerText = currentItem.user;
            counter.innerText = `${currentIndex + 1} / ${galeriItems.length}`;

            if (currentItem.type === 'foto') {
                modalVid.classList.add('hidden');
                modalVid.pause();
                modalImg.src = currentItem.url;
                modalImg.classList.remove('hidden');
            } else {
                modalImg.classList.add('hidden');
                modalVidSrc.src = currentItem.url;
                modalVid.load();
                modalVid.classList.remove('hidden');
            }

            if (currentIndex === 0) {
                btnPrev.classList.add('hidden');
            } else {
                btnPrev.classList.remove('hidden');
            }

            if (currentIndex === galeriItems.length - 1) {
                btnNext.classList.add('hidden');
            } else {
                btnNext.classList.remove('hidden');
            }

            if (galeriItems.length <= 1) {
                btnPrev.classList.add('hidden');
                btnNext.classList.add('hidden');
            }
        }

        function prevMedia() {
            if (currentIndex > 0) {
                currentIndex--;
                updateMediaDisplay();
            }
        }

        function nextMedia() {
            if (currentIndex < galeriItems.length - 1) {
                currentIndex++;
                updateMediaDisplay();
            }
        }

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('mediaModal');
            if (modal && !modal.classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') {
                    prevMedia();
                } else if (e.key === 'ArrowRight') {
                    nextMedia();
                } else if (e.key === 'Escape') {
                    closeMediaModal();
                }
            }
        });
    </script>

</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/user/detail.blade.php ENDPATH**/ ?>