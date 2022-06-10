<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostmarkServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postmark_servers', function (Blueprint $table) {
            $table->id('postmark_server_id');
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('source_server_id')->nullable();
            $table->string('postmark_name')->nullable();
            $table->string('postmark_api_token')->nullable();
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
        Schema::dropIfExists('postmark_servers');
    }
}
