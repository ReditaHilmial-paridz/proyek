<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = Fasilitas::query();
        
        if ($request->has('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('kategori', 'like', '%'.$request->search.'%')
                  ->orWhere('lokasi', 'like', '%'.$request->search.'%');
        }
        
        $fasilitas = $query->get();
        return view('admin.fasilitas.dashboard', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255', 
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            $imagePath = $request->file('gambar')->store('public/fasilitas');
            $validated['gambar'] = str_replace('public/', 'storage/', $imagePath);
    
            Fasilitas::create($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Fasilitas berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Fasilitas $fasilita)
    {
        return response()->json($fasilita);
    }
    
    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                Storage::delete(str_replace('storage/', 'public/', $fasilita->gambar));
                
                // Upload gambar baru
                $imagePath = $request->file('gambar')->store('public/fasilitas');
                $validated['gambar'] = str_replace('public/', 'storage/', $imagePath);
            }
    
            $fasilita->update($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Fasilitas berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Fasilitas $fasilita)
    {
        // Hapus gambar dari storage
        Storage::delete(str_replace('storage/', 'public/', $fasilita->gambar));
        
        $fasilita->delete();
        
        return back()->with('success', 'Fasilitas berhasil dihapus');
    }
}