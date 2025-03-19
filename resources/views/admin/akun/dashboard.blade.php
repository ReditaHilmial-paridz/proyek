@extends('layouts.app')
@section('content')
<div class="container">
        <h1 class="my-4">Manajemen Akun</h1>
        <a href="{{ route('akun.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>

        <!-- Tabel untuk menampilkan data akun -->
        <table class="table table-bordered">
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