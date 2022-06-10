<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportPostmarkServerStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_postmark_server_stats', function (Blueprint $table) {
            $table->id('import_postmark_server_stat_id');
            $table->uuid('import_group_id');
            $table->foreignId('import_status_id')->default(1);
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('postmark_server_id')->nullable();
            $table->json('data')->nullable();
            $table->date('metric_date')->nullable();
            $table->timestamp('processed_at')->nullable();
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
        Schema::dropIfExists('import_postmark_server_stats');
    }
}
