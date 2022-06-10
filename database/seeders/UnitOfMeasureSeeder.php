<?php

namespace Database\Seeders;

use App\Services\SiteSpeed\Models\UnitOfMeasure;
use Illuminate\Database\Seeder;

class UnitOfMeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uoms = collect([
            'points',
            'bytes',
            'seconds',
        ]);

        $uoms->each(function ($uom) {
            UnitOfMeasure::updateOrCreate(
                [
                    'name' => $uom
                ],
                [
                    'name' => $uom
                ],
            );
        });
    }
}
