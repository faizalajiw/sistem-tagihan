<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas;
use App\Models\Dokter;
use Carbon\Carbon;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
    	'kode_pembayaran',
    	'petugas_id',
        'dokter_id',
        'nama_dokter',
    	'npa',
    	'tanggal_bayar',
    	'bulan_bayar',
    	'tahun_bayar',
    	'jumlah_bayar',
    	'keterangan',
    ];

    public function getTanggalBayarAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getJumlahBayarAttribute($value)
    {
        return "Rp ".number_format($value, 0, 2, '.');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}