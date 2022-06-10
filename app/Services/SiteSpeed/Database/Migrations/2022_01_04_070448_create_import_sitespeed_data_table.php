<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportSiteSpeedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_sitespeed_data', function (Blueprint $table) {
            $table->id('import_sitespeed_data_id');
            $table->uuid('docker_process_uuid')->nullable();
            $table->unsignedInteger('import_status_id')->default(1);
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->json('data')->nullable();
            $table->timestamp('processed_at')->nullable();
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
        Schema::dropIfExists('import_sitespeed_data');
    }
}
