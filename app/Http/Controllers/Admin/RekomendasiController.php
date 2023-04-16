<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RekomendasiDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

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
            'nama_dokter_rekomendasi' => 'nullable',
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
            'alamat_rekomendasi' => 'required',
            'ttl' => 'required',
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

    public function suratRekomendasi(Request $request)
    {
        if ($request->ajax()) {
            $data = Rekomendasi::latest();
                // $query->with('spesialis');
                

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('rekomendasi.surat-rekomendasi.print',$row->id).'"class="btn btn-danger btn-sm ml-2" target="_blank">
                    <i class="fas fa-print fa-fw"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    	return view('rekomendasi.surat-rekomendasi');
    }

    public function printRekomendasi($id)
    {
        $data['rekomendasi'] = Rekomendasi::where('id', $id)->first();

        $pdf = PDF::loadView('rekomendasi.rekomendasi-preview',$data);
        return $pdf->stream();
    }
}
