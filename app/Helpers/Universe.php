<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Dokter;

class Universe
{	
	public static function petugas()
	{
		return Petugas::where('user_id', Auth::user()->id)->first();
	}

	public static function dokter()
	{
		return Dokter::where('user_id', Auth::user()->id)->first(); 
	}

	public static function bulanAll()
	{
		return collect([
			[
				'nama_bulan' => 'Januari',
				'kode_bulan' => '01',
			],
			[
				'nama_bulan' => 'Februari',
				'kode_bulan' => '02',
			],
			[
				'nama_bulan' => 'Maret',
				'kode_bulan' => '03',
			],
			[
				'nama_bulan' => 'April',
				'kode_bulan' => '04',
			],
			[
				'nama_bulan' => 'Mei',
				'kode_bulan' => '05',
			],
			[
				'nama_bulan' => 'Juni',
				'kode_bulan' => '06',
			],
			[
				'nama_bulan' => 'Juli',
				'kode_bulan' => '07',
			],
			[
				'nama_bulan' => 'Agustus',
				'kode_bulan' => '08',
			],
			[
				'nama_bulan' => 'September',
				'kode_bulan' => '09',
			],
			[
				'nama_bulan' => 'Oktober',
				'kode_bulan' => '10',
			],
			[
				'nama_bulan' => 'November',
				'kode_bulan' => '11',
			],
			[
				'nama_bulan' => 'Desember',
				'kode_bulan' => '12',
			],
		]);
	}

	// cek status pembayaran (diakses oleh dokter)
	public static function statusPembayaranBulan($bulan, $tagihan_tahun)
	{
		$dokter = Dokter::where('user_id', Auth::user()->id)
            ->first();

	    $pembayaran = Pembayaran::where('dokter_id', $dokter->id)
	        ->where('tahun_bayar', $tagihan_tahun)
	        ->oldest()
	        ->pluck('bulan_bayar')->toArray();


	    foreach ($pembayaran as $key => $bayar) {
	    	if ($bayar == $bulan) {
	    		return "DIBAYAR";
	    	}
	    }

	    // jika pembayaran dibulan tertentu bulan belum dibayar
	    return "BELUM DIBAYAR";
	}


	// cek status pembayaran (diakses oleh petugas)
	public static function statusPembayaran($dokter_id, $tahun, $bulan)
	{
	    $pembayaran = Pembayaran::where('dokter_id', $dokter_id)
	        ->where('tahun_bayar', $tahun)
	        ->oldest()
	        ->pluck('bulan_bayar')->toArray();

	    foreach ($pembayaran as $key => $bayar) {
	    	if ($bayar == $bulan) {
	    		return "DIBAYAR";
	    	}
	    }

	    // jika pembayaran dibulan tertentu bulan belum dibayar
	    return "BELUM DIBAYAR";
	}
}