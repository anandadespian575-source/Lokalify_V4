<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Laporan;
use App\Models\LaporanDestinasi;
use App\Models\GaleriDestinasi;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->input('kategori');

        $query = Destinasi::with('kategori');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_destinasi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $destinasi = $query->latest()->paginate(9);
        $kategori = Kategori::all();

        $semuaDestinasi = Destinasi::select('id', 'nama_destinasi', 'alamat')->get();

        return view('user.dashboard', compact('destinasi', 'kategori', 'search', 'semuaDestinasi'));
    }

    public function dashboard(Request $request)
    {
        return $this->index($request);
    }

    public function detail($id)
    {
        // Memuat relasi galeri.user beserta reviews.user & kategori
        $destinasi = Destinasi::with(['reviews.user', 'kategori', 'galeri.user'])->findOrFail($id);
        $isWishlist = false;
        
        if (auth()->check()) {
            $isWishlist = Wishlist::where('user_id', auth()->id())
                                  ->where('destinasi_id', $id)
                                  ->exists();
        }

        return view('user.detail', compact('destinasi', 'isWishlist'));
    }

    // --- METHOD UNTUK UPLOAD FOTO (MAX 5MB) / VIDEO (MAX 30MB) ---
    public function storeGaleri(Request $request, $id)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:30720', // batas max global 30MB
        ]);

        $file = $request->file('media');
        $extension = strtolower($file->getClientOriginalExtension());
        $fileSizeInKB = $file->getSize() / 1024;

        if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
            if ($fileSizeInKB > 5120) { // 5MB = 5120KB
                return back()->withErrors(['media' => 'Ukuran foto maksimal adalah 5MB.'])->withInput();
            }
            $jenis = 'foto';
        } elseif (in_array($extension, ['mp4', 'mov', 'avi'])) {
            if ($fileSizeInKB > 30720) { // 30MB = 30720KB
                return back()->withErrors(['media' => 'Ukuran video maksimal adalah 30MB.'])->withInput();
            }
            $jenis = 'video';
        } else {
            return back()->withErrors(['media' => 'Format file tidak didukung.']);
        }

        $filePath = $file->store('galeri_destinasi', 'public');

        GaleriDestinasi::create([
            'destinasi_id' => $id,
            'user_id'      => auth()->id(),
            'file_path'    => $filePath,
            'jenis'        => $jenis,
        ]);

        return back()->with('success', 'Media galeri berhasil diunggah!');
    }

    public function wishlist()
    {
        $wishlists = Wishlist::with('destinasi')->where('user_id', auth()->id())->get();
        return view('user.wishlist', compact('wishlists'));
    }

    public function toggleWishlist($id)
    {
        $userId = auth()->id();
        $wishlist = Wishlist::where('user_id', $userId)->where('destinasi_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Destinasi dihapus dari wishlist.');
        } else {
            Wishlist::create(['user_id' => $userId, 'destinasi_id' => $id]);
            return back()->with('success', 'Destinasi ditambahkan ke wishlist.');
        }
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'destinasi_id' => $id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }

    public function storeReport(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $destinasi = Destinasi::findOrFail($id);
        $pesanLaporan = "Alasan: " . $request->alasan . "\nKeterangan: " . $request->keterangan;

        LaporanDestinasi::create([
            'destinasi_id'  => $destinasi->id,
            'user_id'       => auth()->id(),
            'pesan_laporan' => $pesanLaporan,
            'status'        => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Laporan destinasi berhasil dikirim. Terima kasih atas kontribusi Anda!');
    }

    public function pengaturan()
    {
        $riwayatLaporan = Laporan::where('user_id', auth()->id())->latest()->get();
        return view('user.pengaturan', compact('riwayatLaporan'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Pengaturan profil berhasil diperbarui!');
    }

    public function storeBug(Request $request)
    {
        $request->validate([
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:5180',
            'pesan' => 'required|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan_bug', 'public');
        }

        Laporan::create([
            'user_id'    => auth()->id(),
            'foto'       => $fotoPath,
            'pesan'      => $request->pesan,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Laporan bug beserta bukti foto berhasil dikirim, terima kasih!');
    }
}