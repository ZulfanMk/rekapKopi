<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        // Kolom-kolom yang dapat diisi secara massal
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];
}
