<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\JenisBarangRequest;
use App\Http\Resources\JenisBarangResource;
use App\Models\JenisBarang;

class JenisBarangController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBarang = JenisBarang::with('barangs')->orderBy('jenis', 'ASC')->get();
        if ($jenisBarang->count() > 0) {
            return $this->sendResponse(JenisBarangResource::collection($jenisBarang), 'jenisBarang retrieve successfully');
        }
        return $this->sendError('jenisBarang data is empty');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisBarangRequest $request)
    {
        $data = $request->all();
        $jenisBarang = JenisBarang::create($data);
        if ($jenisBarang) {
            return $this->sendResponse(new JenisBarangResource($jenisBarang), 'jenisBarang created');
        }
        return $this->sendError('create jenisBarang failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenisBarang = JenisBarang::with('barangs')->find($id);
        if ($jenisBarang) {
            return $this->sendResponse(new JenisBarangResource($jenisBarang), 'jenisBarang retrieve successfully');
        }
        return $this->sendError('jenisBarang not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisBarangRequest $request, string $id)
    {
        $data = $request->all();
        $jenisBarang = JenisBarang::find($id);
        if ($jenisBarang) {
            $jenisBarang->update($data);
            return $this->sendResponse(new JenisBarangResource($jenisBarang), 'jenisBarang updated');
        }
        return $this->sendError('jenisBarang not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisBarang = JenisBarang::find($id);
        if ($jenisBarang) {
            $jenisBarang->delete();
            return $this->sendResponse(new JenisBarangResource($jenisBarang), 'jenisBarang deleted');
        }
        return $this->sendError('jenisBarang not found');
    }
}
