<?php

namespace Database\Seeders;

use App\Models\TransaksiDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransaksiDetail::create([
            'transaksi_id'  => 1,
            'barang_id'     => 1,
            'stock_awal'         => 100,
            'qty_jual'      => 10,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 2,
            'barang_id'     => 2,
            'stock_awal'         => 100,
            'qty_jual'      => 19,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 3,
            'barang_id'     => 1,
            'stock_awal'         => 90,
            'qty_jual'      => 15,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 4,
            'barang_id'     => 3,
            'stock_awal'         => 100,
            'qty_jual'      => 20,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 4,
            'barang_id'     => 4,
            'stock_awal'         => 100,
            'qty_jual'      => 30,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 5,
            'barang_id'     => 5,
            'stock_awal'         => 100,
            'qty_jual'      => 25,
        ]);

        TransaksiDetail::create([
            'transaksi_id'  => 5,
            'barang_id'     => 2,
            'stock_awal'         => 81,
            'qty_jual'      => 5,
        ]);
    }
}
