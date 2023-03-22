<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Spp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use PDF;

class DokterController extends Controller
{
    public function pembayaranSpp()
    {
        $spp = Spp::all();

        return view('dokter.pembayaran-spp', compact('spp'));
    }

    public function pembayaranSppShow(Spp $spp)
    {
        $dokter = Dokter::where('user_id', Auth::user()->id)
            ->first();

        $pembayaran = Pembayaran::with(['petugas', 'dokter'])
            ->where('dokter_id', $dokter->id)
            ->where('tahun_bayar', $spp->tahun)
            ->oldest()
            ->get();

        return view('dokter.pembayaran-spp-show', compact('pembayaran', 'dokter', 'spp'));
    }

    public function historyPembayaran(Request $request)
    {
        if ($request->ajax()) {
            $dokter = Dokter::where('user_id', Auth::user()->id)
                ->first();
            
            $data = Pembayaran::with(['petugas', 'dokter' => function($query) {
                $query->with(['spesialis']);
            }])
                ->where('dokter_id', $dokter->id)
                ->latest()
                ->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('dokter.history-pembayaran.preview', $row->id).'"class="btn btn-danger btn-sm ml-2" target="_blank">
                    <i class="fas fa-print fa-fw"></i>
                    </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    	
    	return view('dokter.history-pembayaran');
    }

    public function previewHistoryPembayaran($id)
    {
        $data['dokter'] = Dokter::where('user_id', Auth::user()->id)
            ->first();
        
        $data['pembayaran'] = Pembayaran::with(['petugas', 'dokter'])
            ->where('id', $id)
            ->where('dokter_id', $data['dokter']->id)
            ->first();
        
        $pdf = PDF::loadView('dokter.history-pembayaran-preview',$data);
        return $pdf->stream();
    }

    public function laporanPembayaran()
    {
        $spp = Spp::all();
        return view('dokter.laporan', compact('spp'));
    }

    public function printPdf(Request $request)
    {
        $dokter = Dokter::where('user_id', Auth::user()->id)
            ->first();

        $data['pembayaran'] = Pembayaran::with(['petugas', 'dokter'])
            ->where('dokter_id', $dokter->id)
            ->where('tahun_bayar', $request->tahun_bayar)
            ->get();

        $data['data_dokter'] = $dokter;

        if ($data['pembayaran']->count() > 0) {
            $pdf = PDF::loadView('dokter.laporan-preview', $data);
            return $pdf->download('pembayaran-spp-'.$dokter->nama_dokter.'-'.
                $dokter->npa.'-'.
                $request->tahun_bayar.'-'.
                Str::random(9).'.pdf');
        }else{
            return back()->with('error', 'Data Pembayaran Tagihan Anda Tahun '.$request->tahun_bayar.' tidak tersedia');
        }
    }
}
