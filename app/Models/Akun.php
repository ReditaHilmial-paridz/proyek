<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'akuns';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}

