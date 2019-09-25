<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    $gender = ['Male', 'Female'];
    return [
        'gender' => $gender[rand(0,1)],
        'work_id' => rand(1,2),
        'user_id' => factory(App\User::class)->create(),
        'city_id' => $faker->numberBetween(1,100),
        'is_active' => $faker->boolean,
        'country_id' => $faker->numberBetween(1,100)
    ];
});
