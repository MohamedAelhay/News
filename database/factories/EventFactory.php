<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $starts_at = Carbon::createFromTimestamp($faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week')->getTimeStamp()) ;
    $ends_at   = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours( $faker->numberBetween( 1, 8 ) );
    return [
        "main_title"   => $faker->sentence(2),
        "second_title" => $faker->sentence(4),
        "content"      => $faker->paragraph(3),
        'start_date'   => $starts_at,
        'end_date'     => $ends_at,
    ];
});
