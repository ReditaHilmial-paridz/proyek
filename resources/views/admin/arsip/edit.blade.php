@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Data Arsip</h5>
        </div>
        <div class="card-body">
        <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen', $arsip->nama_dokumen) }}" required>
                </div>
                

                <div class="mb-3">
                    <label for="nama_pengirim" class="form-label">Pengirim</label>
                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim', $arsip->nama_pengirim) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_penerima" class="form-label">Penerima</label>
                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" value="{{ old('nama_penerima', $arsip->nama_penerima) }}" required>
                </div>

                <div class="mb-3">
    <label for="kategori" class="form-label">Kategori Surat</label>
    <select class="form-select" id="kategori" name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="Masuk" {{ old('kategori', $arsip->kategori) == 'Masuk' ? 'selected' : '' }}>Masuk</option>
        <option value="Keluar" {{ old('kategori', $arsip->kategori) == 'Keluar' ? 'selected' : '' }}>Keluar</option>
    </select>
</div>


<div class="mb-3">
    <label for="tujuan" class="form-label">Tujuan</label>
    <select class="form-select" id="tujuan" name="tujuan" required>
        <option value="">Pilih Tujuan</option>
        <option value="Pemerintahan" {{ old('tujuan', $arsip->tujuan) == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
        <option value="Pendidikan" {{ old('tujuan', $arsip->tujuan) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
    </select>
</div>

<div class="mb-3">
    <label for="file_arsip" class="form-label">Upload File</label>
    <input type="file" class="form-control @error('file_arsip') is-invalid @enderror" 
           id="file_arsip" name="file_arsip" required
           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
    
    @error('file_arsip')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    @if(isset($arsip->file_path) && $arsip->file_path)
        <div class="mt-2">
            <span class="badge bg-info text-dark">
                File saat ini: 
                <a href="{{ asset('storage/'.$arsip->file_path) }}" target="_blank" class="text-decoration-none">
                    {{ basename($arsip->file_path) }}
                </a>
            </span>
        </div>
    @endif
    
    <small class="text-muted">
        Format: PDF, DOC, DOCX, JPG, PNG (Maks. 10MB)
    </small>
</div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('arsip.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection