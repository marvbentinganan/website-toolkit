<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsTable extends Migration
{

// metric_id
    // metric_source_id
    // metric_priority_id
    // unit_of_measure_id
    // metric_key
    // name
    // minimum_threshold
    // maximum_threshold
    // created_at default now()
    // updated_at default now()
    // deleted_at

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id('metric_id');
            $table->foreignId('metric_source_id')->references('metric_source_id')->on('metric_sources');
            $table->string('metric_key')->nullable();
            $table->string('name')->nullable();
            $table->integer('minimum_threshold')->nullable();
            $table->integer('maximum_threshold')->nullable();
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
        Schema::dropIfExists('metrics');
    }
}
