<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ReportTransaksiRequest;
use App\Http\Resources\ReportTransaksiResource;
use Illuminate\Support\Facades\DB;

class ReportTransaksiController extends BaseController
{
    public function index(ReportTransaksiRequest $request)
    {
        $c_search   = $request->input('c_search', 'kode_transaksi');
        $search     = $request->input('search', '');

        $c_sort     = $request->input('c_sort', 'kode_transaksi');
        $sort       = $request->input('sort', 'ASC');

        $result = DB::select("SELECT transaksi_details.id AS id_trx_detail,barangs.kode_barang, barangs.nama_barang, transaksis.kode_transaksi, transaksis.tgl_transaksi, transaksi_details.stock_awal AS stok, transaksi_details.qty_jual,  jenis_barangs.jenis FROM transaksi_details INNER JOIN barangs ON transaksi_details.barang_id = barangs.id INNER JOIN transaksis ON transaksi_details.transaksi_id = transaksis.id INNER JOIN jenis_barangs ON barangs.jenis_barang_id = jenis_barangs.id where $c_search  LIKE '%$search%' ORDER BY $c_sort $sort");

        return $this->sendResponse(ReportTransaksiResource::collection($result), 'data retrieve successfully');
    }

    public function compareJenis(ReportTransaksiRequest $request)
    {
        $tgl_awal = $request->input('tgl_awal', '1999-01-01');
        $tgl_akhir = $request->input('tgl_akhir', date('Y-m-d'));
        $result = DB::select("SELECT jenis_barangs.jenis, SUM(transaksi_details.qty_jual) as qty_terjual FROM jenis_barangs INNER JOIN barangs ON
		jenis_barangs.id = barangs.jenis_barang_id INNER JOIN transaksi_details ON
		barangs.id = transaksi_details.barang_id INNER JOIN transaksis ON
		transaksi_details.transaksi_id = transaksis.id WHERE transaksis.tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY jenis_barangs.id, jenis_barangs.jenis ORDER BY SUM(transaksi_details.qty_jual) DESC");
        return $this->sendResponse($result, 'data retrieve successfully');
    }
}
