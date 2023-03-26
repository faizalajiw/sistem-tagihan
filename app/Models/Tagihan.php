<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $fillable = [
    	'tahun',
    	'nominal',
    ];

    public function dokter()
    {
    	return $this->hasMany(Dokter::class);
    }
}
