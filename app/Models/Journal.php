<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'judul',
        'nama_dosen',
        'nidn',
        'program_studi',
        'tahun',
        'nama_jurnal',
        'kategori',
        'status',
        'file_jurnal',
        'keterangan',
    ];
}