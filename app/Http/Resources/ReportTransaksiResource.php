<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportTransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id_trx'                => $this->id_trx_detail,
            'kode_barang'           => $this->kode_barang,
            'nama_barang'           => $this->nama_barang,
            'stok'                  => $this->stok,
            'qty_jual'              => $this->qty_jual,
            'tgl_transaksi'         => date('d-m-Y', strtotime($this->tgl_transaksi)),
            'kode_transaksi'        => $this->kode_transaksi,
            'jenis'                 => $this->jenis,
        ];
        return $result;
    }
}
