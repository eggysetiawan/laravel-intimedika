<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationInstalledModalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installation_installed_modality', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installation_id')->constrained('installations')->cascadeOnDelete();
            $table->foreignId('installed_modality_id')->constrained('installed_modalities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installation_installed_modality');
    }
}
