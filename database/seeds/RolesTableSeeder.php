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
        Role::create(['name'=>'Admin', 'description'=> 'Site Admin']);
        Role::create(['name'=>'Staff', 'description'=> 'Site Manager']);
        Role::create(['name'=>'Visitor', 'description'=> 'Visitor with Limited Access']);
    }
}
