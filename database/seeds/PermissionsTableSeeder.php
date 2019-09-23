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
//        Permission::create(['name'=>'show all'   ])->assignRole(['manager', 'visitor']);

        Permission::create(['name'=>'show role'  ])->assignRole(['manager', 'visitor']);
        Permission::create(['name'=>'edit role'  ])->assignRole(['manager']);
        Permission::create(['name'=>'create role'])->assignRole(['manager']);
        Permission::create(['name'=>'delete role'])->assignRole(['manager']);

        Permission::create(['name'=>'show city'  ])->assignRole(['manager', 'visitor']);
        Permission::create(['name'=>'edit city'  ])->assignRole(['manager']);
        Permission::create(['name'=>'create city'])->assignRole(['manager']);
        Permission::create(['name'=>'delete city'])->assignRole(['manager']);

        Permission::create(['name'=>'show job'  ])->assignRole(['manager', 'visitor']);
        Permission::create(['name'=>'edit job'  ])->assignRole(['manager']);
        Permission::create(['name'=>'create job'])->assignRole(['manager']);
        Permission::create(['name'=>'delete job'])->assignRole(['manager']);
    }
}
