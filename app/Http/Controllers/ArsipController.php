<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $perPage = request('per_page') ?? 5;
        $search = request('search');

        $query = Arsip::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', '%' . $search . '%')
                  ->orWhere('nama_pengirim', 'like', '%' . $search . '%')
                  ->orWhere('nama_penerima', 'like', '%' . $search . '%')
                  ->orWhere('tujuan', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        $arsips = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.arsip.dashboard', compact('arsips', 'search'));
    }

    public function create()
    {
        return view('admin.arsip.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dokumen'   => 'required|max:255',
            'nama_pengirim'  => 'required|max:255',
            'nama_penerima'  => 'required|max:255',
            'kategori'       => 'required',
            'tujuan'         => 'required',
            'file_arsip'     => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Proses file arsip
        if ($request->hasFile('file_arsip')) {
            $file = $request->file('file_arsip');
            
            // Mengubah nama file dengan nama dokumen yang dimasukkan, mengganti spasi dengan garis bawah
            $fileName = str_replace(' ', '_', $request->nama_dokumen) . '.' . $file->getClientOriginalExtension();
            
            // Menyimpan file dengan nama baru
            $filePath = $file->storeAs('arsip', $fileName, 'public');
            $validatedData['file_path'] = 'arsip/' . $fileName;
        }

        Arsip::create($validatedData);

        return redirect()->route('arsip.index')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        return view('admin.arsip.show', compact('arsip'));
    }

    public function edit(string $id)
    {
        $arsip = Arsip::findOrFail($id);
        return view('admin.arsip.edit', compact('arsip'));
    }

    public function update(Request $request, string $id)
    {
        $arsip = Arsip::findOrFail($id);

        $validatedData = $request->validate([
            'nama_dokumen'   => 'required|max:255',
            'nama_pengirim'  => 'required|max:255',
            'nama_penerima'  => 'required|max:255',
            'kategori'       => 'required',
            'tujuan'         => 'required',
            'file_arsip'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file_arsip')) {
            if ($arsip->file_path) {
                // Menghapus file lama
                Storage::disk('public')->delete($arsip->file_path);
            }

            $file = $request->file('file_arsip');
            
            // Mengubah nama file dengan nama dokumen yang dimasukkan
            $fileName = str_replace(' ', '_', $request->nama_dokumen) . '.' . $file->getClientOriginalExtension();
            
            // Menyimpan file dengan nama baru
            $filePath = $file->storeAs('arsip', $fileName, 'public');
            $validatedData['file_path'] = 'arsip/' . $fileName;
        }

        $arsip->update($validatedData);

        return redirect()->route('arsip.index')->with('success', 'Surat berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->file_path) {
            // Menghapus file arsip dari storage
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Surat berhasil dihapus!');
    }
}