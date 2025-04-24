<?php
namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian
        $search = $request->input('search');

        // Query data akun
        $akuns = Akun::when($search, function ($query, $search) {
            // Jika ada input pencarian, filter data
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%")
                         ->orWhere('role', 'like', "%$search%");
        }, function ($query) {
            // Jika tidak ada input pencarian, tampilkan semua data
            return $query;
        })->get();

        // Tampilkan view dengan data akun
        return view('admin.akun.dashboard', compact('akuns'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:akuns',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        Akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan');
    }

    public function edit(Akun $akun)
    {
        return view('admin.akun.edit', compact('akun'));
    }

    public function update(Request $request, Akun $akun)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:akuns,email,' . $akun->id,
            'password' => 'nullable|min:6',
            'role' => 'required',
        ]);

        $akun->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $akun->password,
            'role' => $request->role,
        ]);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy(Akun $akun)
    {
        $akun->delete();
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus');
    }
}