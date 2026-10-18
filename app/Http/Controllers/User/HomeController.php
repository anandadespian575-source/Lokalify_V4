<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        $query = Destinasi::with('kategori');

        // Pencarian Berdasarkan Nama Wisata
        if ($request->has('q') && $request->q != '') {
            $query->where('nama_destinasi', 'like', '%' . $request->q . '%')
                  ->orWhere('alamat', 'like', '%' . $request->q . '%');
        }

        // Filter Berdasarkan Kategori jika dipilih
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $destinasi = $query->latest()->get();
        $kategori = Kategori::all();

        // Ambil daftar wishlist user yang sedang login
        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('destinasi_id')->toArray();
        }

        return view('user.home', compact('destinasi', 'kategori', 'userWishlist'));
    }

    public function show($id) {
        $destinasi = Destinasi::with(['kategori', 'reviews.user'])->findOrFail($id);
        
        $isWishlist = false;
        if (Auth::check()) {
            $isWishlist = Wishlist::where('user_id', Auth::id())->where('destinasi_id', $id)->exists();
        }

        return view('user.detail', compact('destinasi', 'isWishlist'));
    }

    // Toggle Wishlist (Tambah / Hapus Wishlist)
    public function toggleWishlist($id) {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())->where('destinasi_id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Dihapus dari Wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'destinasi_id' => $id
            ]);
            return back()->with('success', 'Ditambahkan ke Wishlist!');
        }
    }

    // Simpan Ulasan / Komentar dengan Upload Foto
    public function storeReview(Request $request, $id) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/reviews'), $filename);
            $fotoPath = 'reviews/' . $filename;
        }

        Review::create([
            'user_id' => Auth::id() ?? 1, // Default ke ID 1 jika belum login/testing
            'destinasi_id' => $id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'foto' => $fotoPath
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}