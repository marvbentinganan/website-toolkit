<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportWebServerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_web_server_logs', function (Blueprint $table) {
            $table->id('import_web_server_log_id');
            $table->uuid('import_group_id');
            $table->string('log_unique_id');
            $table->foreignId('import_status_id')->default(1);
            $table->foreignId('domain_id');
            $table->foreignId('server_id');
            $table->string('type');
            $table->json('data');
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
        Schema::dropIfExists('import_web_server_logs');
    }
}
