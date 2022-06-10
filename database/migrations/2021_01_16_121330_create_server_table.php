<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id('server_id');
            $table->string('name')->nullable();
            $table->string('data_center')->nullable();
            $table->string('disk_storage')->nullable();
            $table->string('memory')->nullable();
            $table->string('cpu')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('hostname')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('server');
    }
}
