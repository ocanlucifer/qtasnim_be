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
            'nama_barang'           => $this->barang['nama_barang'],
            'stok'                  => $this->stock_awal,
            'qty_jual'              => $this->qty_jual,
            'tgl_transaksi'         => date('d-m-Y', strtotime($this->transaksi->tgl_transaksi)),
            'jenis'                 => $this->barang->jenis_barang['jenis'],
        ];
        return $result;
        // return parent::toArray($request);
    }
}
