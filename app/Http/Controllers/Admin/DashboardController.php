<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\User;
use App\Models\Review;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $totalDestinasi = Destinasi::count();
        $totalUser = User::where('role', 'user')->count();
        $totalReview = Review::count();
        $totalLaporan = Laporan::where('status', 'pending')->count();
        $destinasiTerbaru = Destinasi::with('kategori')->latest()->take(5)->get();

        // Data tambahan untuk notifikasi pop-up di header
        $latestReviews = Review::with('user', 'destinasi')->latest()->take(3)->get();
        $latestDestinations = Destinasi::latest()->take(2)->get();
        $admin = Auth::user();

        return view('admin.dashboard', compact(
            'totalDestinasi', 
            'totalUser', 
            'totalReview', 
            'totalLaporan', 
            'destinasiTerbaru', 
            'latestReviews', 
            'latestDestinations', 
            'admin'
        ));
    }

    // Halaman Daftar User
    public function usersIndex()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // Halaman Daftar Ulasan / Review (Lengkap dengan foto ulasan & relasi)
    public function reviewsIndex()
    {
        $reviews = Review::with(['user', 'destinasi'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // Halaman Daftar Laporan Pending
    public function laporanPendingIndex()
    {
        $laporans = Laporan::with(['user'])->where('status', 'pending')->latest()->get();
        return view('admin.laporan.pending', compact('laporans'));
    }
}