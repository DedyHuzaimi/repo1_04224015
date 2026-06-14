<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_dosen');
            $table->string('nidn')->nullable();
            $table->string('program_studi');
            $table->year('tahun');
            $table->string('nama_jurnal')->nullable();
            $table->string('kategori')->nullable();
            $table->string('status')->default('Menunggu');
            $table->string('file_jurnal')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};