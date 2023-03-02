<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'id'                    => 1,
            'kode_barang'           => 'B00001',
            'nama_barang'           => 'Kopi',
            'stock'                 => 75,
            'satuan'                => 'Pcs',
            'jenis_barang_id'       => 1,
        ]);

        Barang::create([
            'id'                    => 2,
            'kode_barang'           => 'B00002',
            'nama_barang'           => 'teh',
            'stock'                 => 76,
            'satuan'                => 'Pcs',
            'jenis_barang_id'       => 1,
        ]);

        Barang::create([
            'id'                    => 3,
            'kode_barang'           => 'B00003',
            'nama_barang'           => 'Pasta Gigi',
            'stock'                 => 80,
            'satuan'                => 'Pcs',
            'jenis_barang_id'       => 2,
        ]);

        Barang::create([
            'id'                    => 4,
            'kode_barang'           => 'B00004',
            'nama_barang'           => 'Sabun Mandi',
            'stock'                 => 70,
            'satuan'                => 'Pcs',
            'jenis_barang_id'       => 2,
        ]);

        Barang::create([
            'id'                    => 5,
            'kode_barang'           => 'B00005',
            'nama_barang'           => 'Sampo',
            'stock'                 => 75,
            'satuan'                => 'Pcs',
            'jenis_barang_id'       => 2,
        ]);
    }
}
