<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSpeedMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitespeed_metrics', function (Blueprint $table) {
            $table->id('sitespeed_metric_id');
            $table->string('metric_key');
            $table->string('name')->nullable();
            $table->foreignId('unit_of_measure_id')->nullable();
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
        Schema::dropIfExists('sitespeed_metrics');
    }
}
