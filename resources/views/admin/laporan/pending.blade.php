<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pending - Lokalify Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#f0f4f9] p-8 text-slate-800">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-black">Daftar Laporan Pending 🚨</h2>
                <p class="text-xs text-slate-500 mt-1">Laporan dari user yang memerlukan tindakan peninjauan.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold">← Kembali ke Dashboard</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50 border-b border-slate-100">
                        <th class="py-3.5 px-6">No</th>
                        <th class="py-3.5 px-6">Pelapor</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Waktu Laporan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($laporans as $index => $lap)
                    <tr class="hover:bg-slate-50">
                        <td class="py-4 px-6 text-slate-400 font-bold">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-bold text-slate-800">{{ $lap->user->name ?? 'User Umum' }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-amber-50 text-amber-600 border border-amber-200 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase">
                                {{ $lap->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-400">{{ $lap->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-400">Tidak ada laporan berstatus pending saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>