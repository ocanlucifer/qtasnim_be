<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TransaksiDetailRequest;
use App\Http\Resources\TransaksiDetailResource;
use App\Models\Barang;
use App\Models\TransaksiDetail;

use Illuminate\Http\Request;

class TransaksiDetailController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transaksiDetail = TransaksiDetail::with('transaksi', 'barang');
        if ($request['idtrx']) {
            $transaksiDetail->where('transaksi_id', $request['idtrx']);
        }

        $trxdetail = $transaksiDetail->get();
        if ($transaksiDetail->count() > 0) {
            return $this->sendResponse(TransaksiDetailResource::collection($trxdetail), 'transaksiDetail retrieve successfully');
        }
        return $this->sendError('transaksiDetail data is empty');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiDetailRequest $request)
    {
        $brg_id = $request['barang_id'];
        $brg = Barang::find($brg_id);
        $stockAkhir = $brg->stock - $request['qty_jual'];
        if ($stockAkhir < 0) {
            return $this->sendError('stock tidak mencukupi, saat ini hanya tersedia ' . $brg->stock . ' Pcs');
        }
        $request['stock_awal'] = $brg->stock;
        $data = $request->all();
        $transaksiDetail = TransaksiDetail::create($data);
        if ($transaksiDetail) {
            $brg->update([
                'stock' => $stockAkhir,
            ]);
            return $this->sendResponse(new TransaksiDetailResource($transaksiDetail), 'transaksiDetail created');
        }
        return $this->sendError('create transaksiDetail failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksiDetail = TransaksiDetail::with('transaksi', 'barang')->find($id);
        if ($transaksiDetail) {
            return $this->sendResponse(new TransaksiDetailResource($transaksiDetail), 'transaksiDetail retrieve successfully');
        }
        return $this->sendError('transaksiDetail not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiDetailRequest $request, string $id)
    {
        $brg_id = $request['barang_id'];
        $brg = Barang::find($brg_id);

        $data = $request->all();
        $transaksiDetail = TransaksiDetail::find($id);
        if ($transaksiDetail) {
            $returnStock = $transaksiDetail->qty_jual;

            $transaksiDetail->update($data);

            $stockAkhir = ($brg->stock + $returnStock) - $data['qty_jual'];
            $brg->update([
                'stock' => $stockAkhir,
            ]);

            return $this->sendResponse(new TransaksiDetailResource($transaksiDetail), 'transaksiDetail updated');
        }
        return $this->sendError('transaksiDetail not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksiDetail = TransaksiDetail::find($id);
        if ($transaksiDetail) {
            $brg_id = $transaksiDetail->barang_id;
            $brg = Barang::find($brg_id);
            $returnStock = $transaksiDetail->qty_jual;

            $transaksiDetail->delete();

            $stockAkhir = ($brg->stock + $returnStock);
            $brg->update([
                'stock' => $stockAkhir,
            ]);

            return $this->sendResponse(new TransaksiDetailResource($transaksiDetail), 'transaksiDetail deleted');
        }
        return $this->sendError('transaksiDetail not found');
    }
}
