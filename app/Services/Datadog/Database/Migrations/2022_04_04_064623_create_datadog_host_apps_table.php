<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatadogHostAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datadog_hosts_apps', function (Blueprint $table) {
            $table->id('datadog_hosts_apps_id');
            $table->unsignedBigInteger('datadog_host_id');
            $table->unsignedBigInteger('server_id');
            $table->string('name');
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
        Schema::dropIfExists('datadog_hosts_apps');
    }
}
