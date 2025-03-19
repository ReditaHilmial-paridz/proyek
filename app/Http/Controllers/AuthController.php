<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login admin
    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    // Proses login admin
    public function adminLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            // Periksa role user
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate(); // Regenerasi session
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            } else {
                Auth::logout(); // Logout jika bukan admin
                return back()->withErrors([
                    'email' => 'Anda bukan admin.',
                ]);
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Tampilkan form login user
    public function showUserLoginForm()
    {
        return view('auth.user.login');
    }

    // Proses login user
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Periksa role user
            if (Auth::user()->role === 'user') {
                $request->session()->regenerate();
                return redirect()->intended('/user/dashboard'); // Redirect ke dashboard user
            } else {
                Auth::logout(); // Logout jika bukan user
                return back()->withErrors([
                    'email' => 'Anda bukan user.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Nama, email, atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}