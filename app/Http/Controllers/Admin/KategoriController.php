<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    // 1. Tambahkan method index() untuk menampilkan halaman utama kategori & datanya
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    // 2. Method untuk menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // 3. Method untuk menyimpan data kategori ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}