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
        $dokter_idi_brebes = DB::table('dokter')->where('status', 'IDI Brebes')->count();
        $dokter_idi_luar = DB::table('dokter')->where('status', 'IDI Luar')->count();

    	return view('admin.dashboard', [
    		'total_dokter' => DB::table('dokter')->count(),
    		'total_admin' => DB::table('model_has_roles')->where('role_id', 1)->count(),
    		'total_petugas' => DB::table('petugas')->count(),
    		'pembayaran' => DB::table('pembayaran')->count(),
            'dokter_idi_brebes' => $dokter_idi_brebes,
            'dokter_idi_luar' => $dokter_idi_luar,
    	]);
    }
}
