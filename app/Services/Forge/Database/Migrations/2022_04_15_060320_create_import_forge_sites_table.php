<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportForgeSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_forge_sites', function (Blueprint $table) {
            $table->id('import_forge_site_id');
            $table->uuid('import_group_id');
            $table->foreignId('import_status_id')->default(1);
            $table->unsignedBigInteger('forge_server_id')->nullable();
            $table->json('data');
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
        Schema::dropIfExists('import_forge_sites');
    }
}
