<?php
namespace App\Http\Controllers; // Pastikan namespace ini ada

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Tampilkan view dashboard admin
    }
}
