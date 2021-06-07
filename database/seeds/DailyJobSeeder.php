<?php

use App\DailyJob;
use App\Migration\DailyJob as MigrationDailyJob;
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
        $dailyJobs = MigrationDailyJob::get();

        foreach ($dailyJobs as $dailyJob) {
            DailyJob::create([
                'slug' => $dailyJob->slug,
                'user_id' => $dailyJob->user_id,
                'title' => $dailyJob->title,
                'description' => $dailyJob->description,
                'date' => $dailyJob->date,
                'created_at' => $dailyJob->created_at,
                'updated_at' => $dailyJob->updated_at,
                'deleted_at' => $dailyJob->deleted_at,
            ]);
        }
    }
}
