<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForgeSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forge_sites', function (Blueprint $table) {
            $table->id('forge_site_id');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->unsignedBigInteger('snipeit_asset_id')->nullable();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('directory')->nullable();
            $table->string('repository')->nullable();
            $table->string('repository_provider')->nullable();
            $table->string('repository_branch')->nullable();
            $table->string('repository_status')->nullable();
            $table->string('project_type')->nullable();
            $table->string('app')->nullable();
            $table->string('php_version')->nullable();
            $table->string('app_status')->nullable();
            $table->string('deployment_url')->nullable();
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
        Schema::dropIfExists('forge_sites');
    }
}
