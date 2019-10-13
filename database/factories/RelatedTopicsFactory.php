<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RelatedTopics;
use Faker\Generator as Faker;

$factory->define(RelatedTopics::class, function (Faker $faker) {
    return [
        "article_id" => $faker->numberBetween(1,5),
        "related_id" => $faker->numberBetween(1,5)
    ];
});
