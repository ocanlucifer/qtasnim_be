<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::create([
            'id'                    => 1,
            'kode_transaksi'        => 'TRX00001',
            'tgl_transaksi'         => '2021-05-01',
            'total_transaksi'       => '10',
        ]);

        Transaksi::create([
            'id'                    => 2,
            'kode_transaksi'        => 'TRX00002',
            'tgl_transaksi'         => '2021-05-05',
            'total_transaksi'       => '19',
        ]);

        Transaksi::create([
            'id'                    => 3,
            'kode_transaksi'        => 'TRX00003',
            'tgl_transaksi'         => '2021-05-10',
            'total_transaksi'       => '15',
        ]);

        Transaksi::create([
            'id'                    => 4,
            'kode_transaksi'        => 'TRX00004',
            'tgl_transaksi'         => '2021-05-11',
            'total_transaksi'       => '50',
        ]);

        Transaksi::create([
            'id'                    => 5,
            'kode_transaksi'        => 'TRX00005',
            'tgl_transaksi'         => '2021-05-12',
            'total_transaksi'       => '30',
        ]);
    }
}
