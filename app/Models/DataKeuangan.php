<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeuangan extends Model
{
    use HasFactory;

    protected $table = 'data_keuangan';

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'kategori',
        'jumlah',
        'saldo_akhir',
    ];
}

