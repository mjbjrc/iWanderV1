<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/countries.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('Country table seeded!');
    }
}
