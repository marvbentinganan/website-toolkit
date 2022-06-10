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

        Schema::table('domains', function (Blueprint $table) {
            $table->boolean('sitespeed_check')->default(false);
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

        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn('sitespeed_check');
        });
    }
}
