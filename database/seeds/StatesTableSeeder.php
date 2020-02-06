<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/states.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('States table seeded!');
    }
}
