<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\Petugas;
use App\Models\Pembayaran;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';

    protected $fillable = [
    	'nama_dokter_rekomendasi',
    	'alamat_rekomendasi',
    	'ttl',
    	'no_str',
    	'alamat_praktik_dimiliki',
    	'alamat_praktik_diminta',
    	'idi_cabang',
    	'no_rekomendasi',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function petugas()
    // {
    //     return $this->belongsTo(Petugas::class);
    // }

    // public function tagihan()
    // {
    //     return $this->belongsTo(Tagihan::class);
    // }

    // public function pembayaran()
    // {
    //     return $this->hasMany(Pembayaran::class);
    // }
}