<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\Petugas;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Validator;
use App\Helpers\Bulan;
use App\Models\Dokter;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokter::latest();
            // $data = Dokter::with(['spesialis'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('pembayaran.bayar', $row->npa).'"class="btn btn-primary btn-sm ml-2">
                    <i class="fas fa-money-check"></i> BAYAR
                    </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    	return view('pembayaran.index');
    }

    public function bayar($npa)
    {	
    	$dokter = Dokter::where('npa', $npa)
    	// $dokter = Dokter::with(['spesialis'])
            ->first();

        $tagihan = Tagihan::all();

    	return view('pembayaran.bayar', compact('dokter', 'tagihan'));
    }

    public function tagihan($tahun)
    {
        $tagihan = Tagihan::where('tahun', $tahun)
            ->first();
        
        return response()->json([
            'data' => $tagihan,
            'nominal_rupiah' => 'Rp '.number_format($tagihan->nominal, 0, 2, '.'),
        ]);
    }

    public function prosesBayar(Request $request, $npa)
    {
        $request->validate([
            'jumlah_bayar' => 'required',
        ],[
            'jumlah_bayar.required' => 'Jumlah bayar tidak boleh kosong!'
        ]);

		$petugas = Petugas::where('user_id', Auth::user()->id)
            ->first();
        
        $pembayaran = Pembayaran::whereIn('bulan_bayar', $request->bulan_bayar)
            ->where('tahun_bayar', $request->tahun_bayar)
            ->where('dokter_id', $request->dokter_id)
            ->pluck('bulan_bayar')
            ->toArray();

        if (!$pembayaran) {
            DB::transaction(function() use($request, $petugas) {
                foreach ($request->bulan_bayar as $bulan) {   
                    Pembayaran::create([
                        'kode_pembayaran' => 'IDIBBS'.Str::upper(Str::random(5)),
                        'petugas_id' => $petugas->id,
                        'dokter_id' => $request->dokter_id,
                        'npa' => $request->npa,
                        'tanggal_bayar' => Carbon::now('Asia/Jakarta'),
                        'tahun_bayar' => $request->tahun_bayar,
                        'bulan_bayar' => $bulan,
                        'jumlah_bayar' => $request->jumlah_bayar,
                    ]);
                }
            });
            
            return redirect()->route('pembayaran.history-pembayaran')
                ->with('success', 'Pembayaran berhasil disimpan!');
        }else{
            return back()
                ->with('error', 'Dokter Dengan Nama : '.$request->nama_dokter.' , No ID : '.
                $request->npa.' Sudah Membayar Tagihan di bulan yang diinput ('.
                implode($pembayaran,',').")".' , di Tahun : '.$request->tahun_bayar.' , Pembayaran Dibatalkan');
        }
    }

    public function statusPembayaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokter::latest()
            // $data = Dokter::with(['spesialis'])
                ->get();
                
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('pembayaran.status-pembayaran.show',$row->npa).
                    '"class="btn btn-primary btn-sm">DETAIL</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pembayaran.status-pembayaran');
    }

    public function statusPembayaranShow(Dokter $dokter)
    {
        $tagihan = Tagihan::all();
        return view('pembayaran.status-pembayaran-tahun', compact('dokter', 'tagihan'));
    }

    public function statusPembayaranShowStatus($npa, $tahun)
    {
        $dokter = Dokter::where('npa', $npa)
            ->first();
        
        $tagihan = Tagihan::where('tahun', $tahun)
            ->first();

        $pembayaran = Pembayaran::with(['dokter'])
            ->where('dokter_id', $dokter->id)
            ->where('tahun_bayar', $tagihan->tahun)
            ->get();

        return view('pembayaran.status-pembayaran-show', compact('dokter', 'tagihan', 'pembayaran'));
    }

    public function historyPembayaran(Request $request)
    {
        if ($request->ajax()) {
            $data = Pembayaran::with(['petugas', 'dokter'])
                // $query->with('spesialis');
                ->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="row"><a href="'.route('pembayaran.history-pembayaran.print',$row->id).'"class="btn btn-danger btn-sm ml-2" target="_blank">
                    <i class="fas fa-print fa-fw"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    	return view('pembayaran.history-pembayaran');
    }

    public function printHistoryPembayaran($id)
    {
        $data['pembayaran'] = Pembayaran::with(['petugas', 'dokter'])
            ->where('id', $id)
            ->first();

        $pdf = PDF::loadView('pembayaran.history-pembayaran-preview',$data);
        return $pdf->stream();
    }

    public function laporan()
    {
        return view('pembayaran.laporan');
    }

    public function printPdf(Request $request)
    {
        $tanggal = $request->validate([
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $data['pembayaran'] = Pembayaran::with(['petugas', 'dokter'])
            ->whereBetween('tanggal_bayar', $tanggal)->get();

        if ($data['pembayaran']->count() > 0) {
            $pdf = PDF::loadView('pembayaran.laporan-preview', $data);
            return $pdf->download('pembayaran-tagihan-'.
            Carbon::parse($request->tanggal_mulai)->format('d-m-Y').'-'.
            Carbon::parse($request->tanggal_selesai)->format('d-m-Y').
            Str::random(9).'.pdf');   
        }else{
            return back()->with('error', 'Data pembayaran tanggal '.
                Carbon::parse($request->tanggal_mulai)->format('d-m-Y').' sampai dengan '.
                Carbon::parse($request->tanggal_selesai)->format('d-m-Y').' Tidak Tersedia');
        }
    }
}
