<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebServerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_server_logs', function (Blueprint $table) {
            $table->id('web_server_log_id');
            $table->unsignedBigInteger('web_server_id');
            $table->unsignedBigInteger('ip_address_id');
            $table->unsignedBigInteger('http_method_id');
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('domain_url_id');
            $table->unsignedBigInteger('http_response_id');
            $table->unsignedBigInteger('http_referrer_id');
            $table->integer('bytes_sent');
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
        Schema::dropIfExists('web_server_logs');
    }
}
