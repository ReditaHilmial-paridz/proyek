@extends('layouts.app')
@section('content')
<div class="container">
        <h1 class="my-4">Manajemen Akun</h1>
            <!-- Form Pencarian -->
            <form action="{{ route('akun.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}" style="margin-right: 10px;">
                    <a href="{{ route('akun.create') }}" class="btn text-white px-3" style="background-color: #77a35d; border-radius: 5px;">Tambah Akun</a>
                </div>
            </form>

    <!-- Tabel Akun -->
    <table class="table table-bordered text-center">
        <thead>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $akun->name }}</td>
                <td>{{ $akun->email }}</td>
                <td>{{ $akun->role }}</td>
                <td>
                    <a href="{{ route('akun.edit', $akun->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('akun.destroy', $akun->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection