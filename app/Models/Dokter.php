<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Spp;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\Models\Spesialis;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'user_id',
    	'kode_dokter',
    	'npa',
    	'nama_dokter',
        'jenis_kelamin',
    	'alamat',
    	'no_telepon',
    	'spesialis_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spesialis()
    {
        return $this->belongsTo(Spesialis::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
