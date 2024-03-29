<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(AssignUserRoleSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(WorksTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(VisitorTableSeeder::class);
        $this->call(NewsArticleTableSeeder::class);
        $this->call(RelatedTopicsTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(FoldersTableSeeder::class);
        $this->command->info('Seeded the countries!');
    }
}
