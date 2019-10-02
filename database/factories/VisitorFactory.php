<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visitor;
use Faker\Generator as Faker;

$factory->define(Visitor::class, function (Faker $faker) {
    $gender = ['Male', 'Female'];
    return [
        'gender' => $gender[rand(0,1)],
        'user_id' => factory(App\User::class)->create(),
        'city_id' => $faker->numberBetween(1,100),
        'country_id' => $faker->numberBetween(1,100),
        'is_active' => $faker->boolean,
    ];
});
