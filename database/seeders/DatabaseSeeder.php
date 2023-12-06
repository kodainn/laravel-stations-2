<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
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
        //Movie::factory(50)->create();
        Schedule::factory(20)->create();
        $this->call(SheetTableSeeder::class);
    }
}
