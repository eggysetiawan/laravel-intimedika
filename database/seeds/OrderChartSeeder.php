<?php

use App\OrderChart;
use Illuminate\Database\Seeder;

class OrderChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderChart::class, 500)->create();
    }
}
