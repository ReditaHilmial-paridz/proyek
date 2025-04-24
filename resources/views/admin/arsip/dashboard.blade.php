@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="card p-3 bg-primary text-white">
        <h5 class="m-0">Data Surat Arsip</h5>
    </div>

    <!-- Kontrol & Pencarian -->
    <div class="d-flex justify-content-between mt-3 align-items-center flex-wrap">
        <div class="d-flex mb-2">
            <a href="{{ route('arsip.create') }}" class="btn btn-primary me-2">
                <i class="fas fa-plus me-1"></i>Tambah Data
            </a>
            <form method="GET" action="{{ route('arsip.index') }}" class="d-flex" style="width: 250px;">
                <input type="text" name="search" class="form-control form-control-sm" 
                       placeholder="Cari dokumen/pengirim/penerima..." 
                       value="{{ request('search') }}"
                       aria-label="Search">
                <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="d-flex align-items-center mb-2">
            <span class="me-2">Tampilkan:</span>
            <select class="form-select form-select-sm" style="width: 80px;" onchange="window.location.href = '?per_page=' + this.value + '&search={{ request('search') }}'">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
    </div>

    @if(request('search'))
    <div class="alert alert-info mt-2 mb-3">
        Menampilkan hasil pencarian untuk: <strong>{{ request('search') }}</strong>
        <a href="{{ route('arsip.index') }}" class="float-end text-decoration-none">× Hapus pencarian</a>
    </div>
    @endif

    <!-- Tabel -->
    <div class="card mt-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Dokumen</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Kategori</th>
                        <th>Tujuan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsips as $arsip)
                    <tr>
                        <td>{{ ($arsips->currentPage() - 1) * $arsips->perPage() + $loop->iteration }}</td>
                        <td>{{ $arsip->created_at->translatedFormat('d/m/Y H:i') }}</td>
                        <td>{{ $arsip->nama_dokumen }}</td>
                        <td>{{ $arsip->nama_pengirim }}</td>
                        <td>{{ $arsip->nama_penerima }}</td>
                        <td>
    <span class="badge border 
        {{ $arsip->kategori == 'Masuk' ? 'border-success text-success' : 'border-danger text-danger' }} 
        bg-white">
        {{ $arsip->kategori }}
    </span>
</td>

                        <td>{{ $arsip->tujuan }}</td>
                        <td>
                            @if($arsip->file_path)
                                <a href="{{ asset('storage/' . $arsip->file_path) }}" target="_blank">
                                    {{ basename($arsip->file_path) }}
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('arsip.edit', $arsip->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if($arsip->file_path)
                                <a href="{{ asset('storage/' . $arsip->file_path) }}" class="btn btn-success" target="_blank" title="Download">
                                    <i class="bi bi-download"></i>
                                </a>
                                @endif
                                <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-2 mb-md-0">
                    Menampilkan <strong>{{ $arsips->firstItem() }}</strong> - <strong>{{ $arsips->lastItem() }}</strong> dari <strong>{{ $arsips->total() }}</strong> data
                </div>
                <div>
                    <ul class="pagination pagination-sm m-0">
                        @if ($arsips->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $arsips->previousPageUrl() }}&per_page={{ request('per_page') }}&search={{ request('search') }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        @foreach ($arsips->getUrlRange(1, $arsips->lastPage()) as $page => $url)
                            @if ($page == $arsips->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}&per_page={{ request('per_page') }}&search={{ request('search') }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($arsips->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $arsips->nextPageUrl() }}&per_page={{ request('per_page') }}&search={{ request('search') }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection