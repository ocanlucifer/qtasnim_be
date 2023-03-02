<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;

class BarangController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::with('jenis_barang', 'transaksi_details')->orderBy('kode_barang', 'ASC')->get();
        if ($barang->count() > 0) {
            return $this->sendResponse(BarangResource::collection($barang), 'barang retrieve successfully');
        }
        return $this->sendError('barang data is empty');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        // generate autonumber kode barang
        $brg = Barang::All()->last();
        if ($brg) {
            $next = sprintf("%05s", (int)substr($brg->kode_barang, -5) + 1);
        } else {
            $next = '00001';
        }
        $nextnumber = 'B' . $next;

        //end autonumber

        $request['satuan'] = 'Pcs';
        $request['kode_barang'] = $nextnumber;
        $data = $request->all();
        $barang = Barang::create($data);
        if ($barang) {
            return $this->sendResponse(new BarangResource($barang), 'barang created');
        }
        return $this->sendError('create barang failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::with('jenis_barang', 'transaksi_details')->find($id);
        if ($barang) {
            return $this->sendResponse(new BarangResource($barang), 'barang retrieve successfully');
        }
        return $this->sendError('barang not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, string $id)
    {
        $request['satuan'] = 'Pcs';
        $data = $request->all();
        $barang = Barang::find($id);
        if ($barang) {
            $barang->update($data);
            return $this->sendResponse(new BarangResource($barang), 'barang updated');
        }
        return $this->sendError('barang not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);
        if ($barang) {
            $barang->delete();
            return $this->sendResponse(new BarangResource($barang), 'barang deleted');
        }
        return $this->sendError('barang not found');
    }
}
