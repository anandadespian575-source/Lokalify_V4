<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar User - Lokalify Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#f0f4f9] p-8 text-slate-800">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-black">Daftar Pengguna (User) 👥</h2>
                <p class="text-xs text-slate-500 mt-1">Data user terdaftar yang mengambil peran sebagai wisatawan.</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold">← Kembali ke Dashboard</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50 border-b border-slate-100">
                        <th class="py-3.5 px-6">No</th>
                        <th class="py-3.5 px-6">Nama Lengkap</th>
                        <th class="py-3.5 px-6">Email</th>
                        <th class="py-3.5 px-6">Terdaftar Sejak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50">
                        <td class="py-4 px-6 text-slate-400 font-bold"><?php echo e($index + 1); ?></td>
                        <td class="py-4 px-6 font-bold text-slate-800"><?php echo e($u->name); ?></td>
                        <td class="py-4 px-6 text-slate-600"><?php echo e($u->email); ?></td>
                        <td class="py-4 px-6 text-slate-400"><?php echo e($u->created_at->format('d M Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-400">Belum ada user terdaftar.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\Lokalify\resources\views/admin/users/index.blade.php ENDPATH**/ ?>