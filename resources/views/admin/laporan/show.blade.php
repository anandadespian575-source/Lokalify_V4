<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Lokalify 📍</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body class="bg-[#f0f4f9] min-h-screen text-slate-800 p-8">

    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-black text-slate-800 tracking-tight">Detail & Konfirmasi Laporan 📝</h2>
            <a href="/admin/laporan" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold rounded-xl transition">
                ← Kembali
            </a>
        </div>

        <div class="glass-card rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
            <div class="grid grid-cols-2 gap-4 pb-4 border-b border-slate-100">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase">Nama Pelapor</span>
                    <p class="text-sm font-bold text-slate-800 mt-1">{{ $laporan->user->name ?? 'User Tidak Dikenal' }}</p>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase">Status Saat Ini</span>
                    <div class="mt-1">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $laporan->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase">Pesan Laporan</span>
                <p class="text-sm text-slate-700 mt-1 bg-slate-50 p-4 rounded-xl border border-slate-100 leading-relaxed">
                    {{ $laporan->pesan }}
                </p>
            </div>

            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase">Foto Bukti Laporan</span>
                <div class="mt-2">
                    @if($laporan->foto)
                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Bukti" class="w-48 h-48 object-cover rounded-xl border shadow-sm">
                    @else
                        <p class="text-xs text-slate-400 italic">Tidak ada foto bukti yang dilampirkan.</p>
                    @endif
                </div>
            </div>

            <!-- Form Konfirmasi & Jawaban Admin -->
            <form action="/admin/laporan/{{ $laporan->id }}" method="POST" class="pt-4 border-t border-slate-100 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Ubah Status Laporan</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 focus:bg-white focus:border-sky-400 focus:outline-none transition">
                        <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="terkonfirmasi" {{ $laporan->status == 'terkonfirmasi' ? 'selected' : '' }}>Terkonfirmasi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Jawaban / Tanggapan Admin</label>
                    <textarea name="jawaban" rows="4" placeholder="Tulis tanggapan atau solusi untuk laporan ini..." class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 focus:bg-white focus:border-sky-400 focus:outline-none transition">{{ old('jawaban', $laporan->jawaban) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-bold rounded-xl shadow-lg shadow-sky-500/30 transition">
                        Simpan Perubahan & Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>