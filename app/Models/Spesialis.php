<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;

class Spesialis extends Model
{
    use HasFactory;

    protected $fillable = [
    	'nama_spesialis',
    	'kompetensi_keahlian',
    ];

    public function dokter()
    {
    	return $this->hasMany(Dokter::class);
    }
}
