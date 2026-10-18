<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanDestinasi;
use Illuminate\Http\Request;

class LaporanDestinasiController extends Controller
{
    public function index()
    {
        $laporandestinasi = LaporanDestinasi::with(['destinasi', 'user'])->latest()->paginate(10);
        return view('admin.laporan-destinasi.index', compact('laporandestinasi'));
    }

    public function destroy($id)
    {
        $laporan = LaporanDestinasi::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan destinasi berhasil dihapus.');
    }
}