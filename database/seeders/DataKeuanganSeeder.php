<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataKeuangan;

class DataKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        DataKeuangan::create([
            'tanggal' => '2024-05-05',
            'deskripsi' => 'Pemasukan dari penjualan produk X',
            'kategori' => 'pemasukan',
            'jumlah' => 10000,
            'saldo_akhir' => 10000,
        ]);

        // Tambahkan data keuangan lainnya sesuai kebutuhan
    }
}

