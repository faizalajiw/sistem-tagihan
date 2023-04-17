<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DokterDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Tagihan;
use App\Models\Petugas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-dokter'])->only(['index', 'show']);
        $this->middleware(['permission:create-dokter'])->only(['create', 'store']);
        $this->middleware(['permission:update-dokter'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-dokter'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DokterDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        $dokter = Dokter::all();
        $tagihan = Tagihan::all();
        // $spesialis = Spesialis::all();

        return view('admin.dokter.index', compact('dokter', 'tagihan'));
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
            'nama_dokter' => 'required',
            'username' => 'required|unique:users',
            'npa' => 'required|unique:dokter',
            'alamat' => 'nullable|required',
            'no_telepon' => 'required|numeric',
            'praktek1' => 'required',
            'praktek2' => 'nullable',
            'praktek3' => 'nullable',
            'status' => 'nullable|required',
        ]);

        if ($validator->passes()) {
            DB::transaction(function() use($request){
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('idi2023'),
                ]);

                $user->assignRole('dokter');

                Dokter::create([
                    'user_id' => $user->id,
                    'kode_dokter' => 'DR'.Str::upper(Str::random(6)),
                    'npa' => $request->npa,
                    'nama_dokter' => $request->nama_dokter,
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'praktek1' => $request->praktek1,
                    'praktek2' => $request->praktek2,
                    'praktek3' => $request->praktek3,
                    'status' => $request->status,
                ]);
            });

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
        $dokter = Dokter::with(['tagihan'])->findOrFail($id);
        // $dokter = Dokter::with(['spesialis', 'tagihan'])->findOrFail($id);
        return response()->json(['data' => $dokter]);
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
            'nama_dokter' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'praktek1' => 'required',
            'praktek2' => 'nullable',
            'praktek3' => 'nullable',
            'status' => 'nullable',
        ]);

        if ($validator->passes()) {
            Dokter::findOrFail($id)->update([
                'nama_dokter' => $request->nama_dokter,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'praktek1' => $request->praktek1,
                'praktek2' => $request->praktek2,
                'praktek3' => $request->praktek3,
                'status' => $request->status,
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
        $dokter = Dokter::findOrFail($id);
        User::findOrFail($dokter->user_id)->delete();
        $dokter->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
