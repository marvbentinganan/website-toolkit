<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForgeServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forge_servers', function (Blueprint $table) {
            $table->id('forge_server_id');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('server_id')->nullable();
            $table->string('name');
            $table->string('size');
            $table->string('region');
            $table->string('php_version');
            $table->ipAddress('ip_address');
            $table->ipAddress('private_ip_address');
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
        Schema::dropIfExists('forge_servers');
    }
}
