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
        Permission::create(['name'=>'show role'  ])->assignRole(['Staff', 'Visitor']);
        Permission::create(['name'=>'edit role'  ])->assignRole(['Staff']);
        Permission::create(['name'=>'create role'])->assignRole(['Staff']);
        Permission::create(['name'=>'delete role'])->assignRole(['Staff']);

        Permission::create(['name'=>'show city'  ])->assignRole(['Staff', 'Visitor']);
        Permission::create(['name'=>'edit city'  ])->assignRole(['Staff']);
        Permission::create(['name'=>'create city'])->assignRole(['Staff']);
        Permission::create(['name'=>'delete city'])->assignRole(['Staff']);

        Permission::create(['name'=>'show job'  ])->assignRole(['Staff', 'Visitor']);
        Permission::create(['name'=>'edit job'  ])->assignRole(['Staff']);
        Permission::create(['name'=>'create job'])->assignRole(['Staff']);
        Permission::create(['name'=>'delete job'])->assignRole(['Staff']);

        Permission::create(['name'=>'show staff'  ])->assignRole(['Staff', 'Visitor']);
        Permission::create(['name'=>'edit staff'  ])->assignRole(['Staff']);
        Permission::create(['name'=>'create staff'])->assignRole(['Staff']);
        Permission::create(['name'=>'delete staff'])->assignRole(['Staff']);
    }
}
