<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductSeason;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            SeasonSeeder::class,
        ]);
        ProductSeason::factory(20)->create();
    }
}
