<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Menampilkan daftar semua destinasi.
     */
    public function index()
    {
        $destinasi = Destinasi::with('kategori')->latest()->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    /**
     * Menampilkan halaman form untuk menambah destinasi baru.
     */
    public function create()
    {
        // Mengambil data kategori untuk dropdown di form
        $kategori = Kategori::all(); 
        
        return view('admin.destinasi.create', compact('kategori'));
    }

    /**
     * Menyimpan data destinasi baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            'nama_destinasi'    => 'required|string|max:255',
            'kategori_id'       => 'required|exists:kategoris,id', // Sesuaikan dengan nama tabel kategori di database Anda ('kategori' atau 'kategoris')
            'deskripsi_singkat' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
            'foto'              => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'alamat'            => 'required|string',
            'jam_buka'          => 'required|string',
            'link_maps'         => 'nullable|string',
        ]);

        // 2. Proses Upload Foto ke storage/app/public/destinasi
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('destinasi', 'public');
        }

        // 3. Simpan Ke Database
        Destinasi::create([
            'nama_destinasi'    => $request->nama_destinasi,
            'slug'              => Str::slug($request->nama_destinasi),
            'deskripsi'         => $request->deskripsi_singkat, // Mengisi kolom 'deskripsi' agar tidak terjadi database error (NOT NULL)
            'kategori_id'       => $request->kategori_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'foto'              => $fotoPath,
            'alamat'            => $request->alamat,
            'jam_buka'          => $request->jam_buka,
            'link_maps'         => $request->link_maps,
        ]);

        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail destinasi tertentu.
     */
    public function show($id)
    {
        $destinasi = Destinasi::with('kategori')->findOrFail($id);
        return view('admin.destinasi.show', compact('destinasi'));
    }

    /**
     * Menampilkan halaman form edit destinasi.
     */
    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $kategori = Kategori::all();
        
        return view('admin.destinasi.edit', compact('destinasi', 'kategori'));
    }

    /**
     * Memperbarui data destinasi di database.
     */
    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $request->validate([
            'nama_destinasi'    => 'required|string|max:255',
            'kategori_id'       => 'required|exists:kategoris,id',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'alamat'            => 'required|string',
            'jam_buka'          => 'required|string',
            'link_maps'         => 'nullable|string',
        ]);

        $fotoPath = $destinasi->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('destinasi', 'public');
        }

        $destinasi->update([
            'nama_destinasi'    => $request->nama_destinasi,
            'slug'              => Str::slug($request->nama_destinasi),
            'deskripsi'         => $request->deskripsi_singkat,
            'kategori_id'       => $request->kategori_id,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'foto'              => $fotoPath,
            'alamat'            => $request->alamat,
            'jam_buka'          => $request->jam_buka,
            'link_maps'         => $request->link_maps,
        ]);

        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil diperbarui!');
    }

    /**
     * Menghapus data destinasi dari database.
     */
    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        // Hapus file foto terkait
        if ($destinasi->foto && Storage::disk('public')->exists($destinasi->foto)) {
            Storage::disk('public')->delete($destinasi->foto);
        }

        $destinasi->delete();

        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil dihapus!');
    }
}