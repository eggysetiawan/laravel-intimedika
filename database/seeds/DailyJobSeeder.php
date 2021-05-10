<?php

use App\DailyJob;
use Illuminate\Database\Seeder;

class DailyJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DailyJob::class, 1000)->create();
    }
}
