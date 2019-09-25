<?php

use App\User;
use Illuminate\Database\Seeder;

class AssignUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('staff');
        User::find(3)->assignRole('visitor');
    }
}
