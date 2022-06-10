<?php

namespace Database\Seeders;

use App\Models\MetricPriority;
use Illuminate\Database\Seeder;

class MetricPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = collect([
            ['name' => 'Critical', 'sort_order' => 10],
            ['name' => 'High', 'sort_order' => 20],
            ['name' => 'Medium', 'sort_order' => 30],
            ['name' => 'Low', 'sort_order' => 40],
            ['name' => 'Undefined', 'sort_order' => 50],
        ]);

        $priorities->each(function ($priority) {
            MetricPriority::updateOrCreate(
                [
                    'name' => $priority['name']
                ],
                [
                    'name' => $priority['name'],
                    'sort_order' => $priority['sort_order']
                ]
            );
        });
    }
}
