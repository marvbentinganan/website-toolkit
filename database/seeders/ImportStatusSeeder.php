<?php

namespace Database\Seeders;

use App\Models\ImportStatus;
use Illuminate\Database\Seeder;

class ImportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Pending', 'Success', 'Failure'])->each(function ($status) {
            ImportStatus::updateOrCreate(
                [
                    'name' => $status
                ],
                [
                    'name' => $status
                ]
            );
        });
    }
}
