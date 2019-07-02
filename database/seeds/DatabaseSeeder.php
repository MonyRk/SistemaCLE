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
        // $this->call([UsersTableSeeder::class]);
        // $this->call([PersonaSeeder::class]);
        // $this->call([AlumnosSeeder::class]);
        $this->call([DocentesSeeder::class]);
    }
}
