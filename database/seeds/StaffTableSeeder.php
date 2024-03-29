<?php

use App\Staff;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (factory(Staff::class, 5)->create() as $member)
        {
            $member->images()->create(['image'=>'public/staff/kotNIgklO1bfaWIAP0QCpaBIhWQlDbS0o28HQB1k.jpeg']);
        }
    }
}
