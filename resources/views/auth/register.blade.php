<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden">
    
    <div class="absolute top-10 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-lg bg-white/95 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 relative z-10 my-8">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-2xl mb-3 shadow-inner text-3xl">
                📍
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Bergabung dengan Lokalify</h1>
            <p class="text-xs text-slate-500 mt-1 font-medium">Temukan destinasi lokal atau kelola wisata sebagai admin 🗺️</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 text-xs text-red-700 shadow-sm">
                <p class="font-bold mb-1">⚠️ Terjadi Kesalahan:</p>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Tambahkan id="registerForm" -->
        <form id="registerForm" action="/register" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="Min. 6 karakter"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi sandi"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none text-slate-800 text-sm transition">
                </div>
            </div>

            <div class="pt-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Daftar Sebagai 👥</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center justify-center gap-2 p-3 border-2 border-slate-200 rounded-xl cursor-pointer hover:border-emerald-500 transition text-sm font-semibold text-slate-700">
                        <input type="radio" name="role" value="user" {{ old('role', 'user') === 'user' ? 'checked' : '' }} onchange="handleRoleChange()" class="accent-emerald-600">
                        <span>User Biasa 🧳</span>
                    </label>
                    <label class="flex items-center justify-center gap-2 p-3 border-2 border-slate-200 rounded-xl cursor-pointer hover:border-emerald-500 transition text-sm font-semibold text-slate-700">
                        <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }} onchange="handleRoleChange()" class="accent-emerald-600">
                        <span>Admin 🛡️</span>
                    </label>
                </div>
            </div>

            <div id="secretCodeBox" class="{{ old('role') === 'admin' ? '' : 'hidden' }} transition-all duration-300">
                <label class="block text-xs font-bold text-amber-700 uppercase tracking-wider mb-1">🔐 Kode Rahasia Admin</label>
                <input type="password" name="secret_code" placeholder="Masukkan kode rahasia admin"
                    class="w-full px-4 py-3 bg-amber-50/70 border border-amber-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:bg-white focus:outline-none text-slate-800 text-sm transition">
            </div>

            <!-- Tombol dengan ID submitBtnReg -->
            <button type="submit" id="submitBtnReg" 
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-600/30 transition duration-200 flex items-center justify-center gap-2 text-sm mt-4">
                <span id="btnTextReg">Daftar Akun Sekarang ✨</span>
            </button>
        </form>

        <div class="mt-6 text-center pt-4 border-t border-slate-100">
            <p class="text-sm text-slate-600">
                Sudah punya akun? 
                <a href="/login" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline">
                    Masuk di Sini ➔
                </a>
            </p>
        </div>
    </div>

    <script>
        function handleRoleChange() {
            const isAdmin = document.querySelector('input[name="role"][value="admin"]').checked;
            const box = document.getElementById('secretCodeBox');
            if (isAdmin) {
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        }

        // Script Animasi Loading Register
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtnReg');
            const btnText = document.getElementById('btnTextReg');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses Pendaftaran...
            `;
        });
    </script>
</body>
</html>