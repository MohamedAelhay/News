<?php

use App\User;
use Illuminate\Database\Seeder;

class assignUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->assignRole('super admin');
    }
}
