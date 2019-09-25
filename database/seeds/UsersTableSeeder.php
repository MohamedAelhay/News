<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        User::create([
            'fname' => 'Mohamed',
            'lname' => 'Abd Elhay',
            'phone' => "01011160239",
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => Str::random(10),
        ]);
        factory(App\User::class, 4)->create();
    }
}
