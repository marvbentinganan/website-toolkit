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
        $this->call([
            ImportStatusSeeder::class,
            SiteSpeedMetricSeeder::class,
            UnitOfMeasureSeeder::class,
            PostmarkMetricSeeder::class,
            MetricPrioritySeeder::class,
        ]);
    }
}
