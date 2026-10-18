<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Kursor berkedip santai saat mengetik */
        .cursor-blink {
            display: inline-block;
            width: 8px;
            height: 1.1em;
            background-color: #10b981;
            margin-left: 3px;
            vertical-align: middle;
            animation: blink 0.9s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Animasi Melayang & Berdenyut Santai untuk Logo */
        @keyframes smoothFloatLogo {
            0%, 100% { transform: translateY(0px) scale(1); filter: drop-shadow(0 20px 30px rgba(16, 185, 129, 0.2)); }
            50% { transform: translateY(-10px) scale(1.02); filter: drop-shadow(0 25px 35px rgba(16, 185, 129, 0.35)); }
        }

        .animate-smooth-logo {
            animation: smoothFloatLogo 5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Glow Decorative Elements -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    <!-- 1. SPLASH / WELCOME SCREEN -->
    <div id="welcomeScreen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/98 backdrop-blur-xl p-6 md:p-12 transition-all duration-1000">
        <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            
            <!-- SEBELAH KIRI: Teks Sambutan (Rapi & Santai) -->
            <div id="textSection" class="md:col-span-8 text-left space-y-4 opacity-0 transition-all duration-1000 transform translate-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/30 rounded-full text-emerald-400 text-xs font-bold uppercase tracking-widest">
                    <span>📍 Lokalify AI Assistant</span>
                </div>
                
                <div class="text-slate-100 text-base md:text-lg leading-relaxed font-medium min-h-[200px] whitespace-pre-line" id="typewriterContainer">
                    <span id="typewriterText"></span><span id="cursor" class="cursor-blink"></span>
                </div>
            </div>

            <!-- SEBELAH KANAN: Logo Lokalify (Double Animasi Fade & Float) -->
            <div id="logoSection" class="md:col-span-4 flex justify-center items-center opacity-0 transition-all duration-1000 transform scale-90">
                <div class="animate-smooth-logo relative">
                    <div class="absolute inset-0 bg-emerald-500/30 rounded-full blur-2xl transform scale-110"></div>
                    <div class="relative w-40 h-40 md:w-56 md:h-56 bg-slate-800/80 border-2 border-emerald-500/40 rounded-3xl flex flex-col items-center justify-center shadow-2xl backdrop-blur-md">
                        <span class="text-6xl md:text-7xl mb-2">📍</span>
                        <span class="text-2xl font-black text-white tracking-wider">Lokalify</span>
                        <span class="text-xs text-emerald-400 font-semibold uppercase tracking-widest mt-1">Virtual Assistant</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 2. KONTEN UTAMA (FORM LOGIN) -->
    <div id="loginCard" class="opacity-0 transition-all duration-1000 transform translate-y-6 w-full max-w-md bg-white/95 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-white/20 relative z-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-2xl mb-3 shadow-inner">
                <span class="text-3xl">📍</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Lokalify</h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">Jelajahi destinasi lokal terbaik 🗺️</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 text-sm text-red-700">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form id="loginForm" action="/login" method="POST" class="space-y-5">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" required placeholder="nama@email.com"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm">
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition text-sm flex items-center justify-center gap-2">
                <span id="btnText">Masuk Sekarang 🚀</span>
            </button>
        </form>

        <div class="mt-8 text-center pt-6 border-t border-slate-100">
            <p class="text-sm text-slate-600">
                Belum punya akun? <a href="/register" class="font-bold text-emerald-600 hover:underline">Daftar Akun Baru 📍</a>
            </p>
        </div>
    </div>

    <!-- JAVASCRIPT ANIMASI SANTAI & DOUBLE FADE -->
    <script>
        // Teks sambutan yang sudah dirapikan agar lebih padat, jelas, dan ramah dibaca
        const fullText = `Selamat Datang di Lokalify! 🌿

Jelajahi berbagai destinasi wisata dengan informasi yang
lengkap dan mendetail. Temukan daya tarik, fasilitas, serta
berbagai hal menarik dari setiap destinasi untuk membantu
perjalananmu lebih mudah dan terencana.

Didukung Lokalify AI, asisten cerdas yang siap membantumu
mencari informasi dan rekomendasi wisata sesuai kebutuhanmu.

Lokalify — Temukan Destinasi, Jelajahi Informasi, Mulai Petualanganmu! ✨`;

        let index = 0;
        const typingSpeed = 35; // Kecepatan ketik santai (35ms per karakter)
        const typewriterElement = document.getElementById("typewriterText");
        const cursorElement = document.getElementById("cursor");
        const textSection = document.getElementById("textSection");
        const logoSection = document.getElementById("logoSection");
        const welcomeScreen = document.getElementById("welcomeScreen");
        const loginCard = document.getElementById("loginCard");

        // 1. Fungsi Mengetik Teks Santai
        function typeWriter() {
            if (index < fullText.length) {
                typewriterElement.textContent += fullText.charAt(index);
                index++;
                
                // Jeda santai saat mendeteksi tanda baca atau baris baru
                let char = fullText.charAt(index - 1);
                let extraDelay = 0;
                if (char === '.' || char === '!' || char === '?') extraDelay = 350;
                else if (char === '\n') extraDelay = 250;

                setTimeout(typeWriter, typingSpeed + extraDelay);
            } else {
                // Selesai mengetik: Tahan sebentar lalu jalankan FADE-OUT ganda
                setTimeout(() => {
                    cursorElement.style.display = "none";

                    // Fade-out Teks dan Logo secara bersamaan
                    textSection.classList.remove("opacity-100", "translate-y-0");
                    textSection.classList.add("opacity-0", "-translate-y-4");

                    logoSection.classList.remove("opacity-100", "scale-100");
                    logoSection.classList.add("opacity-0", "scale-90");

                    // Sembunyikan layar sambutan lalu tampilkan form login
                    setTimeout(() => {
                        welcomeScreen.classList.add("opacity-0", "pointer-events-none");

                        setTimeout(() => {
                            welcomeScreen.classList.add("hidden");
                            loginCard.classList.remove("opacity-0", "translate-y-6");
                            loginCard.classList.add("opacity-100", "translate-y-0");
                        }, 800);
                    }, 800);

                }, 2200); // Waktu baca santai setelah teks selesai (2.2 detik)
            }
        }

        // 2. Mulai Animasi saat Dokumen Dimuat
        document.addEventListener("DOMContentLoaded", function () {
            // FADE-IN Awal: Teks & Logo muncul bersamaan secara halus
            setTimeout(() => {
                textSection.classList.remove("opacity-0", "translate-y-4");
                textSection.classList.add("opacity-100", "translate-y-0");

                logoSection.classList.remove("opacity-0", "scale-90");
                logoSection.classList.add("opacity-100", "scale-100");

                // Mulai mengetik setelah animasi awal muncul
                setTimeout(typeWriter, 600);
            }, 300);
        });

        // 3. Script Indikator Loading Tombol saat Form disubmit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memuat Dashboard...
            `;
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/auth/login.blade.php ENDPATH**/ ?>