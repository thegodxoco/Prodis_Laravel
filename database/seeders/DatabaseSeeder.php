<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // By default "db:seed" executes DatabaseSeeder. We need to invoke call() with all the other 
        // seeders we want to execute.
        $this->call([
            OfferSeeder::class,
            CategorySeeder::class,
            UserSeeder::class
        ]);
    }
}
