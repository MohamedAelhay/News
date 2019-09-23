<?php

use App\Work;
use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::create(['name' => 'Writer',   'description' => 'Article Writer']);
        Work::create(['name' => 'Reporter', 'description' => 'News Reporter']);
    }
}
