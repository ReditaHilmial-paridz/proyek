@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Tambah Akun</h1>
        <form action="{{ route('akun.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            <option value="siswa aktif">Siswa Aktif</option>
            <option value="calon siswa">Calon Siswa</option>
            <option value="alumni">Alumni</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    </div>
@endsection