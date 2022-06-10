<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSitespeedMetricDataTableAddMetricIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sitespeed_metric_data', function (Blueprint $table) {
            $table->unsignedBigInteger('metric_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sitespeed_metric_data', function (Blueprint $table) {
            $table->dropColumn('metric_id');
        });
    }
}
