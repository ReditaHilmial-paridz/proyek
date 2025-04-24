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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::guard('web')->attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard'); // Gunakan nama route
            }
            Auth::logout();
        }
    
        return back()->withErrors(['email' => 'Kredensial admin tidak valid']);
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
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Gunakan guard 'akun' (bukan 'akuns')
        if (Auth::guard('akun')->attempt($credentials)) {
            $allowedRoles = ['siswa aktif', 'calon siswa', 'alumni'];
            $user = Auth::guard('akun')->user();
            
            if (!in_array($user->role, $allowedRoles)) {
                Auth::guard('akun')->logout();
                return back()->withErrors(['email' => 'Role tidak valid untuk login user']);
            }
    
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }
    
        return back()->withErrors(['email' => 'Email atau password salah']);
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