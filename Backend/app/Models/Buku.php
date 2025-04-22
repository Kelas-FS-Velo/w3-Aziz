<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'jumlah_halaman',
        'kategori',
        'sinopsis',
        'cover_buku',
        'status',
        'lokasi_rak',
    ];

    public $timestamps = true;
}
