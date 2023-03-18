<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = [
    	'tahun',
    	'nominal',
    ];

    public function dokter()
    {
    	return $this->hasMany(Dokter::class);
    }
}
