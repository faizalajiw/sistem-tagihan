<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $dokter_laki_laki = DB::table('dokter')->where('jenis_kelamin', 'Laki-laki')->count();
        $dokter_perempuan = DB::table('dokter')->where('jenis_kelamin', 'Perempuan')->count();

    	return view('admin.dashboard', [
    		'total_dokter' => DB::table('dokter')->count(),
    		'total_spesialis' => DB::table('spesialis')->count(),
    		'total_admin' => DB::table('model_has_roles')->where('role_id', 1)->count(),
    		'total_petugas' => DB::table('petugas')->count(),
            'dokter_laki_laki' => $dokter_laki_laki,
            'dokter_perempuan' => $dokter_perempuan,
    	]);
    }
}
