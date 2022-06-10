<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSpeedMetricDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitespeed_metric_data', function (Blueprint $table) {
            $table->id('sitespeed_metric_data_id');
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->foreignId('sitespeed_metric_id');
            $table->foreignId('unit_of_measure_id')->nullable();
            $table->double('median', 8, 2)->nullable();
            $table->double('mean', 8, 2)->nullable();
            $table->double('min', 8, 2)->nullable();
            $table->double('p90', 8, 2)->nullable();
            $table->double('max', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_speed_metric_data');
    }
}
