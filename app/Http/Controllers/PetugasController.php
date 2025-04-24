<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    /**
     * Tampilkan daftar petugas.
     */
    public function index()
    {
        $petugas = Petugas::all();
        return view('admin.petugas.dashboard', compact('petugas'));
    }

    /**
     * Simpan data petugas ke dalam database.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:50',
                'kontak' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
            ]);

            // Simpan data
            $petugas = Petugas::create($validatedData);

            // Response sukses
            return response()->json([
                'success' => true,
                'petugas' => $petugas
            ]);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset dan simpan ulang data petugas.
     */
    public function resetStore(Request $request)
    {
        // Validasi data
        $request->validate([
            'petugas' => 'required|array',
            'petugas.*.nama' => 'required|string|max:255',
            'petugas.*.jabatan' => 'required|string|max:50',
            'petugas.*.kontak' => 'required|string|max:20',
            'petugas.*.email' => 'nullable|email|max:255',
        ]);

        // Hapus semua data petugas
        Petugas::truncate();

        // Simpan data baru
        foreach ($request->petugas as $data) {
            Petugas::create([
                'nama' => $data['nama'],
                'jabatan' => $data['jabatan'],
                'kontak' => $data['kontak'],
                'email' => $data['email'] ?? null,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update data petugas berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:50',
            'kontak' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        return response()->json(['success' => true, 'petugas' => $petugas]);
    }

    /**
     * Hapus data petugas berdasarkan ID.
     */
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Download template Excel untuk import petugas
     */
    public function template()
    {
        // Jika menggunakan Laravel Excel
        // return Excel::download(new PetugasTemplateExport(), 'template_petugas.xlsx');
        
        // Alternatif tanpa package Excel
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_petugas.csv"',
        ];

        $columns = ['Nama', 'Jabatan', 'Kontak', 'Email'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}