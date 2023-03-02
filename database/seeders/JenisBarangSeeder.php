<?php

namespace Database\Seeders;

use App\Models\JenisBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisBarang::create([
            'id'        => 1,
            'jenis'     => 'Konsumsi',
        ]);

        JenisBarang::create([
            'id'        => 2,
            'jenis'     => 'Pembersih',
        ]);
    }
}
