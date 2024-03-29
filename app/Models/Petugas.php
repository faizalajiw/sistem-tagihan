<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pembayaran;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'kode_petugas',
    	'nama_petugas',
        // 'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokter()
    {
    	return $this->hasMany(Dokter::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
