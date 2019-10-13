<?php

use App\RelatedTopics;
use Illuminate\Database\Seeder;

class RelatedTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RelatedTopics::class, 50)->create();
    }
}
