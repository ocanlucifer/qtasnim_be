<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\TransaksiRequest;
use App\Http\Resources\TransaksiResource;
use App\Models\Transaksi;

class TransaksiController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('transaksi_details')->orderBy('kode_transaksi', 'ASC')->get();
        if ($transaksi->count() > 0) {
            return $this->sendResponse(TransaksiResource::collection($transaksi), 'transaksi retrieve successfully');
        }
        return $this->sendError('transaksi data is empty');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request)
    {
        // generate autonumber kode transaksi
        $trx = Transaksi::All()->last();
        if ($trx) {
            $next = sprintf("%05s", (int)substr($trx->kode_transaksi, -5) + 1);
        } else {
            $next = '00001';
        }
        $nextnumber = 'B' . $next;

        //end autonumber

        $request['kode_transaksi'] = $nextnumber;
        $data = $request->all();
        $transaksi = Transaksi::create($data);
        if ($transaksi) {
            return $this->sendResponse(new TransaksiResource($transaksi), 'transaksi created');
        }
        return $this->sendError('create transaksi failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with('transaksi_details')->find($id);
        if ($transaksi) {
            return $this->sendResponse(new TransaksiResource($transaksi), 'transaksi retrieve successfully');
        }
        return $this->sendError('transaksi not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransaksiRequest $request, string $id)
    {
        $data = $request->all();
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->update($data);
            return $this->sendResponse(new TransaksiResource($transaksi), 'transaksi updated');
        }
        return $this->sendError('transaksi not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->delete();
            return $this->sendResponse(new TransaksiResource($transaksi), 'transaksi deleted');
        }
        return $this->sendError('transaksi not found');
    }
}
