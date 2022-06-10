<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitOfMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_measures', function (Blueprint $table) {
            $table->id('unit_of_measure_id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sitespeed_metric_units_of_measure', function (Blueprint $table) {
            $table->id('sitespeed_metric_unit_of_measure_id');
            $table->foreignId('unit_of_measure_id');
            $table->foreignId('sitespeed_metric_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitespeed_metric_units_of_measure');
        Schema::dropIfExists('unit_of_measures');
    }
}
