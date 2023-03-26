<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Validator;
use App\DataTables\TagihanDataTable;

class TagihanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-tagihan'])->only(['index', 'show']);
        $this->middleware(['permission:create-tagihan'])->only(['create', 'store']);
        $this->middleware(['permission:update-tagihan'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-tagihan'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TagihanDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view('admin.tagihan.index');
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
            'tahun' => ['required', 'unique:tagihan'],
            'nominal' => ['required', 'numeric'],
        ]);

        if ($validator->passes()) {
            Tagihan::create($request->all());
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
        $tagihan = Tagihan::findOrFail($id);
        return response()->json(['data' => $tagihan]);
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
            'nominal' => ['required', 'numeric']
        ]);

        if ($validator->passes()) {
            Tagihan::findOrFail($id)->update($request->all());
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
        Tagihan::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
