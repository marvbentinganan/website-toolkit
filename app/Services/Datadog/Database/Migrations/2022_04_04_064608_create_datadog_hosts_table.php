<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatadogHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datadog_hosts', function (Blueprint $table) {
            $table->id('datadog_host_id');
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('service_host_id');
            $table->string('hostname');
            $table->boolean('status');
            $table->string('agent_version');
            $table->string('platform');
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
        Schema::dropIfExists('datadog_hosts');
    }
}
