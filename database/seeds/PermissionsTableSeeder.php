<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'show role'  ])->assignRole(['super admin', 'admin', 'guest']);
        Permission::create(['name'=>'edit role'  ])->assignRole(['super admin', 'admin']);
        Permission::create(['name'=>'create role'])->assignRole(['super admin', 'admin']);
        Permission::create(['name'=>'delete role'])->assignRole(['super admin']);

        Permission::create(['name'=>'show city'  ])->assignRole(['super admin', 'admin', 'guest']);
        Permission::create(['name'=>'edit city'  ])->assignRole(['super admin', 'admin']);
        Permission::create(['name'=>'create city'])->assignRole(['super admin', 'admin']);
        Permission::create(['name'=>'delete city'])->assignRole(['super admin']);

    }
}
