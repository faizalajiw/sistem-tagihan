<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DataTables\SpesialisDataTable;
use App\Models\Spesialis;

class SpesialisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-spesialis'])->only(['index', 'show']);
        $this->middleware(['permission:create-spesialis'])->only(['create', 'store']);
        $this->middleware(['permission:update-spesialis'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-spesialis'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SpesialisDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();    
        }

        return view('admin.spesialis.index');
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
            'nama_spesialis' => 'required|unique:spesialis',
            'kompetensi_keahlian' => 'required',
        ],[
            'nama_spesialis.required' => 'spesialis tidak boleh kosong!',
            'nama_spesialis.unique' => 'spesialis sudah terdaftar!',
            'kompetensi_keahlian.required' => 'kompetensi keahlian tidak boleh kosong!',
        ]);

        if ($validator->passes()) {
            Spesialis::create($request->all());

            return response()->json(['message' => 'Data berhasil disimpan!']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spesialis = Spesialis::findOrFail($id);

        return response()->json(['data' => $spesialis]);
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
            'nama_spesialis' => 'required',
            'kompetensi_keahlian' => 'required',
        ],[
            'nama_spesialis.required' => 'nama spesialis tidak boleh kosong!',
            'kompetensi_keahlian.required' => 'kompetensi keahlian tidak boleh kosong!',
        ]);

        if ($validator->passes()) {
            Spesialis::findOrFail($id)->update($request->all());

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
        Spesialis::findOrFail($id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
