<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/cities.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('Cities table seeded!');
    }
}
