<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    // Jika nama tabel bukan 'siswas', tentukan nama tabel secara manual
    protected $table = 'arsip'; // Ganti dengan nama tabel yang sesuai
}
