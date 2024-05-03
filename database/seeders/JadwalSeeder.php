<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            'hari' => 'Senin',
            'tanggal' => '2024-04-30',
            'jam_mulai' => '08:00',
            'jam_selesai' => '17:00',
            'keterangan' => 'Shift Pagi'
        ]);//
    }
}
