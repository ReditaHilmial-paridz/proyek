<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class SiswaController extends Controller
{
    /**
     * Tampilkan daftar siswa dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $siswas = Siswa::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        })->get();

        return view('admin.siswa.dashboard', compact('siswas'));
    }

    /**
     * Simpan data siswa ke dalam database.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'status' => 'required|string|max:50',
                'tanggal_masuk' => 'required|date',
                'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
            ]);

            $siswa = Siswa::create($validatedData);

            return response()->json([
                'success' => true,
                'siswa' => $siswa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset dan simpan ulang data siswa.
     */
    public function resetStore(Request $request)
    {
        $request->validate([
            'siswas' => 'required|array',
            'siswas.*.nama' => 'required|string|max:255',
            'siswas.*.status' => 'required|string|max:50',
            'siswas.*.tanggal_masuk' => 'required|date',
            'siswas.*.tanggal_keluar' => 'nullable|date|after_or_equal:siswas.*.tanggal_masuk',
        ]);

        Siswa::truncate();

        foreach ($request->siswas as $data) {
            Siswa::create([
                'nama' => $data['nama'],
                'status' => $data['status'],
                'tanggal_masuk' => $data['tanggal_masuk'],
                'tanggal_keluar' => $data['tanggal_keluar'] ?? null,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update data siswa berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nama' => $request->nama,
            'status' => $request->status,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        return response()->json(['success' => true, 'siswa' => $siswa]);
    }

    /**
     * Hapus data siswa berdasarkan ID.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Download template data siswa dalam format Excel.
     */
    
}
