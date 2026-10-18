<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Login User & Admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pengecekan role user: Admin ke dashboard admin, User ke dashboard user
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    // Proses Register User Baru
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $role = 'user';

        // Jika user memilih mendaftar sebagai Admin
        if ($request->input('role') === 'admin') {
            // Validasi input kode rahasia
            if (!$request->filled('secret_code')) {
                return back()->withInput()->withErrors([
                    'secret_code' => 'Kode rahasia admin wajib diisi untuk mendaftar sebagai Admin!'
                ]);
            }

            // Pengecekan kode rahasia LOKALIFY2026
            if ($request->secret_code === 'LOKALIFY2026') {
                $role = 'admin';
            } else {
                return back()->withInput()->withErrors([
                    'secret_code' => 'Kode rahasia admin salah! Periksa kembali kode Anda.'
                ]);
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}