<?php

namespace App\DataTables;

use App\Models\Pembayaran;
use Yajra\DataTables\DataTables;

class PembayaranDataTable
{
    public function data()
    {
        $data = Pembayaran::with(['dokter' => function ($query) {
            $query->with('spesialis');
        }, 'petugas'])->latest();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->id .
                    '" class="btn btn-danger btn-sm ml-2 btn-delete">
                        <i class="fas fa-trash fa-fw"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
