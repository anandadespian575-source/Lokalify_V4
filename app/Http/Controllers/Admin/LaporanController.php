<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $laporans = Laporan::with(['user'])->latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function show($id) {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:pending,terkonfirmasi',
            'jawaban' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
            'jawaban' => $request->jawaban,
        ]);

        return redirect('/admin/laporan')->with('success', 'Laporan berhasil dikonfirmasi dan dijawab!');
    }
}