<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ReportTransaksiRequest;
use App\Http\Resources\ReportTransaksiResource;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportTransaksiController extends BaseController
{
    public function index(ReportTransaksiRequest $request)
    {
        $trx = TransaksiDetail::with('transaksi', 'barang');
        $rowPerPage = $request->input('rowPerPage', 10);

        $c_search   = $request['c_search'];
        $search     = $request['search'];

        $c_sort     = $request['c_sort'];
        $sort       = $request['sort'];

        if ($c_search && $search) {
            if ($c_search == 'kode_transaksi' or $c_search == 'tgl_transaksi') {
                $relasi = 'transaksi';
            } else if ($c_search == 'nama_barang') {
                $relasi = 'barang';
            }
            $trx->whereHas($relasi, function ($q) use ($c_search, $search) {
                $q->where($c_search, 'LIKE', '%' . $search . '%');
            });
        }

        // if ($c_sort && $sort) {
        //     if ($c_sort == 'kode_transaksi' or $c_sort == 'tgl_transaksi') {
        //         $relasi2 = 'transaksi';
        //     } else if ($c_sort == 'nama_barang') {
        //         $relasi2 = 'barang';
        //     }
        //     $trx->with([$relasi2 => function ($q2) use ($c_sort, $sort) {
        //         if ($sort == 'DESC') {
        //             $q2->orderByDesc($c_sort, $sort);
        //         } else {
        //             $q2->orderBy($c_sort, $sort);
        //         }
        //     }]);
        // $trx->orderBy('kode_transaksi', $sort);
        // }
        $result = $trx->get();
        // $result = DB::select(DB::raw('SELECT transaksi_details.id AS id_trx_detail,barangs.kode_barang, barangs.nama_barang, transaksis.kode_transaksi, transaksis.tgl_transaksi, transaksi_details.stock_awal AS stok, transaksi_details.qty_jual,  jenis_barangs.jenis FROM transaksi_details INNER JOIN barangs ON transaksi_details.barang_id = barangs.id INNER JOIN transaksis ON transaksi_details.transaksi_id = transaksis.id INNER JOIN jenis_barangs ON barangs.jenis_barang_id = jenis_barangs.id'));

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
