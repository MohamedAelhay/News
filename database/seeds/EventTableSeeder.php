<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use App\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (factory(Event::class, 5)->create() as $event)
        {
            $event->images()->create(['image'=>'public/staff/kotNIgklO1bfaWIAP0QCpaBIhWQlDbS0o28HQB1k.jpeg']);
            $event->visitors()->sync([1,2,3,4,5]);
            $event->locations()->create([
                "address"  => $faker->city(),
                'latitude' => $faker->latitude(),
                'longitude'=> $faker->longitude(),
            ]);
        }
    }
}
