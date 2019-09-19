<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'admin', 'description'=> 'Site Admin']);
        Role::create(['name'=>'manager', 'description'=> 'Site Manager']);
        Role::create(['name'=>'visitor', 'description'=> 'Visitor with Limited Access']);
    }
}
