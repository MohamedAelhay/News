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
        Role::create(['name'=>'super admin', 'description'=> 'Site General Manager']);
        Role::create(['name'=>'admin', 'description'=> 'can create & edit roles']);
        Role::create(['name'=>'guest', 'description'=> 'can see roles only']);
    }
}