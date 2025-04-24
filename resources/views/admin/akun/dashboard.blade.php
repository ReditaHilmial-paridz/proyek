@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Manajemen Akun</h1>
    
    <!-- Form Pencarian -->
    <form action="{{ route('akun.index') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-9 col-sm-12">
                <div class="input-group">
                    <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <a href="{{ route('akun.create') }}" class="btn btn-success w-100 shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Akun
                </a>
            </div>
        </div>
    </form> 

    <!-- Tabel Akun -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akuns as $akun)
                <tr>
                    <td data-label="No">{{ $loop->iteration }}</td>
                    <td data-label="Nama">{{ $akun->name }}</td>
                    <td data-label="Email">{{ $akun->email }}</td>
                    <td data-label="Role">
                        <span class="role-badge role-{{ str_replace(' ', '-', strtolower($akun->role)) }}">
                            {{ $akun->role }}
                        </span>
                    </td>
                    <td data-label="Aksi" class="action-buttons">
                        <a href="{{ route('akun.edit', $akun->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $akun->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="confirmDeleteModal-{{ $akun->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus akun ini dengan nama {{ $akun->name}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('akun.destroy', $akun->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<style>
    .role-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 500;
        display: inline-block;
        border: 1px solid;
        background-color: transparent;
        color: #000000;
        min-width: 110px;
        text-align: center;
        box-sizing: border-box;
        font-size: 0.9rem;
    }

    .role-calon-siswa {
        border-color: #28A745;
        background-color: rgba(40, 167, 69, 0.1);
    }

    .role-siswa-aktif {
        border-color: #007BFF;
        background-color: rgba(0, 123, 255, 0.1);
    }

    .role-alumni {
        border-color: #FFC107;
        background-color: rgba(255, 193, 7, 0.1);
    }

    /* Responsive Styles */
    @media (max-width: 767.98px) {
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            display: none;
        }
        
        tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        
        td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            text-align: right;
            border-bottom: 1px solid #dee2e6;
        }
        
        td::before {
            content: attr(data-label);
            font-weight: bold;
            text-align: left;
            padding-right: 1rem;
        }
        
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        
        .role-badge {
            margin-left: auto;
        }
    }

    @media (max-width: 576px) {
        .role-badge {
            font-size: 0.8rem;
            padding: 4px 8px;
            min-width: 90px;
        }
        
        .action-buttons {
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            flex: 1 0 auto;
        }
        
        .input-group {
            flex-direction: column;
        }
        
        .input-group .form-control,
        .input-group .btn {
            width: 100%;
            margin-right: 0;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection