<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surat_kabars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('nama_pengirim');
            $table->string('nama_penerima');
            $table->string('kategori');
            $table->string('tujuan');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_kabars');
    }
};