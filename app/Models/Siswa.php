<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Jika nama tabel bukan 'siswas', tentukan nama tabel secara manual
    protected $table = 'siswa'; // Ganti dengan nama tabel yang sesuai
}
