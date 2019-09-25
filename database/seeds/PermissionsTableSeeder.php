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
        Permission::create(['name'=>'show role'  ])->assignRole(['staff', 'visitor']);
        Permission::create(['name'=>'edit role'  ])->assignRole(['staff']);
        Permission::create(['name'=>'create role'])->assignRole(['staff']);
        Permission::create(['name'=>'delete role'])->assignRole(['staff']);

        Permission::create(['name'=>'show city'  ])->assignRole(['staff', 'visitor']);
        Permission::create(['name'=>'edit city'  ])->assignRole(['staff']);
        Permission::create(['name'=>'create city'])->assignRole(['staff']);
        Permission::create(['name'=>'delete city'])->assignRole(['staff']);

        Permission::create(['name'=>'show job'  ])->assignRole(['staff', 'visitor']);
        Permission::create(['name'=>'edit job'  ])->assignRole(['staff']);
        Permission::create(['name'=>'create job'])->assignRole(['staff']);
        Permission::create(['name'=>'delete job'])->assignRole(['staff']);

        Permission::create(['name'=>'show staff'  ])->assignRole(['staff', 'visitor']);
        Permission::create(['name'=>'edit staff'  ])->assignRole(['staff']);
        Permission::create(['name'=>'create staff'])->assignRole(['staff']);
        Permission::create(['name'=>'delete staff'])->assignRole(['staff']);
    }
}
