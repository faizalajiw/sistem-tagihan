<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Dokter;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // seed permission

        // dokter
        Permission::create([
            'name' => 'create-dokter',
        ]);

        Permission::create([
            'name' => 'read-dokter',
        ]);

        Permission::create([
            'name' => 'update-dokter',
        ]);

        Permission::create([
            'name' => 'delete-dokter',
        ]);

        // users
        Permission::create([
            'name' => 'create-users',
        ]);

        Permission::create([
            'name' => 'read-users',
        ]);

        Permission::create([
            'name' => 'update-users',
        ]);

        Permission::create([
            'name' => 'delete-users',
        ]);

        // tagihan
        Permission::create([
            'name' => 'create-tagihan',
        ]);

        Permission::create([
            'name' => 'read-tagihan',
        ]);

        Permission::create([
            'name' => 'update-tagihan',
        ]);

        Permission::create([
            'name' => 'delete-tagihan',
        ]);

        // roles
        Permission::create([
            'name' => 'create-roles',
        ]);

        Permission::create([
            'name' => 'read-roles',
        ]);

        Permission::create([
            'name' => 'update-roles',
        ]);

        Permission::create([
            'name' => 'delete-roles',
        ]);

        // permissions
        Permission::create([
            'name' => 'create-permissions',
        ]);

        Permission::create([
            'name' => 'read-permissions',
        ]);

        Permission::create([
            'name' => 'update-permissions',
        ]);

        Permission::create([
            'name' => 'delete-permissions',
        ]);

        // pembayaran
        Permission::create([
            'name' => 'create-pembayaran',
        ]);

        Permission::create([
            'name' => 'read-pembayaran',
        ]);

        Permission::create([
            'name' => 'update-pembayaran',
        ]);

        Permission::create([
            'name' => 'delete-pembayaran',
        ]);

        // seed tagihan
        Tagihan::create([
            'tahun' => '2020',
            'nominal' => 165000,
        ]);

        Tagihan::create([
            'tahun' => '2021',
            'nominal' => 170000,
        ]);

        Tagihan::create([
            'tahun' => '2022',
            'nominal' => 175000,
        ]);

        // seed role
        $role1 = Role::create([
            'name' => 'admin'
        ]);

        $role1->syncPermissions([
            'create-dokter', 'read-dokter', 'update-dokter', 'delete-dokter', 
            'create-tagihan', 'read-tagihan', 'update-tagihan', 'delete-tagihan',
            'create-users', 'read-users', 'update-users', 'delete-users',
            'create-roles', 'read-roles', 'update-roles', 'delete-roles',
            'create-pembayaran', 'read-pembayaran', 'update-pembayaran', 'delete-pembayaran',
            'create-permissions', 'read-permissions', 'update-permissions', 'delete-permissions',
        ]);

        $role2 = Role::create([
            'name' => 'petugas'
        ]);

        $role2->syncPermissions([
            'create-dokter', 'read-dokter', 'update-dokter', 'delete-dokter',
            'create-tagihan', 'read-tagihan', 'update-tagihan', 'delete-tagihan',
            'create-pembayaran', 'read-pembayaran', 'update-pembayaran', 'delete-pembayaran',
        ]);

        $role3 = Role::create([
            'name' => 'dokter'
        ]);

    	$user1 = User::create([
    		'username' => 'admin123',
    		'email' => 'admin@example.com',
    		'password' => Hash::make('password'),
    	]);
        $user1->assignRole('admin');

        $petugas1 = Petugas::create([
            'user_id' => $user1->id,
            'kode_petugas' => 'PTG'.Str::upper(Str::random(5)),
            'nama_petugas' => 'Administrator',
            // 'jenis_kelamin' => 'Laki-laki',
        ]);

		$user2 = User::create([
    		'username' => 'elaina123',
    		'email' => 'elaina@example.com',
    		'password' => Hash::make('password'),
    	]);
        $user2->assignRole('petugas');

        $petugas2 = Petugas::create([
            'user_id' => $user2->id,
            'kode_petugas' => 'PTG'.Str::upper(Str::random(5)),
            'nama_petugas' => 'Elaina San',
            // 'jenis_kelamin' => 'Perempuan',
        ]);

    	$user3 = User::create([
    		'username' => 'dokterindonesia',
    		'email' => 'dokterindonesia@example.com',
    		'password' => Hash::make('password'),
    	]);
        $user3->assignRole('dokter');

        Dokter::create([
            'user_id' => $user3->id,
            'kode_dokter' => 'DR'.Str::upper(Str::random(6)),
            'npa' => '08909978',
            'nama_dokter' => 'Dokter Indonesia',
            // 'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Metal Float',
            'no_telepon' => '08599876098',
        ]);
    }
}