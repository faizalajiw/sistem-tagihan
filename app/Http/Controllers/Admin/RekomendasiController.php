<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RekomendasiDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\Validator;

class RekomendasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-rekomendasi'])->only(['index', 'show']);
        $this->middleware(['permission:create-rekomendasi'])->only(['create', 'store']);
        $this->middleware(['permission:update-rekomendasi'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-rekomendasi'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RekomendasiDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view('admin.rekomendasi.index');
        // return view('admin.dokter.index', compact('dokter', 'tagihan', 'spesialis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokter_rekomendasi' => 'required',
            'alamat_rekomendasi' => 'nullable',
            'ttl' => 'nullable',
            'no_str' => 'nullable',
            'alamat_praktik_dimiliki' => 'nullable',
            'alamat_praktik_diminta' => 'nullable',
            'idi_cabang' => 'nullable',
            'no_rekomendasi' => 'nullable',
        ]);

        if ($validator->passes()) {
            Rekomendasi::create([
                'nama_dokter_rekomendasi' => $request->nama_dokter_rekomendasi,
                'alamat_rekomendasi' => $request->alamat_rekomendasi,
                'ttl' => $request->ttl,
                'no_str' => $request->no_str,
                'alamat_praktik_dimiliki' => $request->alamat_praktik_dimiliki,
                'alamat_praktik_diminta' => $request->alamat_praktik_diminta,
                'idi_cabang' => $request->idi_cabang,
                'no_rekomendasi' => $request->no_rekomendasi,
            ]);
            return response()->json(['message' => 'Data berhasil disimpan!']);   
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        // $dokter = Dokter::with(['spesialis', 'tagihan'])->findOrFail($id);
        return response()->json(['data' => $rekomendasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokter_rekomendasi' => 'required',
            'alamat_rekomendasi' => 'nullable',
            'ttl' => 'nullable',
            'no_str' => 'nullable',
            'alamat_praktik_dimiliki' => 'nullable',
            'alamat_praktik_diminta' => 'nullable',
            'idi_cabang' => 'nullable',
            'no_rekomendasi' => 'nullable',
        ]);

        if ($validator->passes()) {
            Rekomendasi::findOrFail($id)->update([
                'nama_dokter_rekomendasi' => $request->nama_dokter_rekomendasi,
                'alamat_rekomendasi' => $request->alamat_rekomendasi,
                'ttl' => $request->ttl,
                'no_str' => $request->no_str,
                'alamat_praktik_dimiliki' => $request->alamat_praktik_dimiliki,
                'alamat_praktik_diminta' => $request->alamat_praktik_diminta,
                'idi_cabang' => $request->idi_cabang,
                'no_rekomendasi' => $request->no_rekomendasi,
            ]);

            return response()->json(['message' => 'Data berhasil diupdate!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
