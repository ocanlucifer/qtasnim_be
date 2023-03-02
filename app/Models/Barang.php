<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stock',
        'satuan',
        'jenis_barang_id',
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id', 'id');
    }

    public function transaksi_details()
    {
        return $this->hasMany(TransaksiDetail::class, 'barang_id', 'id');
    }
}
