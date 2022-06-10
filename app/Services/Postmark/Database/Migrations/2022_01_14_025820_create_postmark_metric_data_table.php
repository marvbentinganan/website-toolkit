<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostmarkMetricDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postmark_metric_data', function (Blueprint $table) {
            $table->id('postmark_metric_data_id');
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('postmark_server_id')->nullable();
            $table->foreignId('postmark_metric_id');
            $table->double('value', 8, 2)->nullable();
            $table->date('metric_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('postmark_metric_data');
    }
}
