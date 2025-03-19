<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Akun</h1>
        <form action="{{ route('akun.update', $akun->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method spoofing untuk update -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $akun->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $akun->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control" required>
                    <option value="siswa aktif" {{ $akun->role == 'siswa aktif' ? 'selected' : '' }}>Siswa Aktif</option>
                    <option value="calon siswa" {{ $akun->role == 'calon siswa' ? 'selected' : '' }}>Calon Siswa</option>
                    <option value="alumni" {{ $akun->role == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>