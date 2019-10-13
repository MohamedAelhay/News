<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $type = ["news", "article"];
    return [
        "main_title" => $faker->sentence(3),
        "second_title" => $faker->sentence(6),
        "content" => $faker->paragraph(3),
        "type" => $type[rand(0,1)],
        "user_id" => $faker->numberBetween(6,10)
    ];
});
