<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacsInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacs_installations', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('hospital_id')->constrained('hospitals')->cascadeOnDelete();
            $table->dateTime('handover_date')->nullable();
            $table->dateTime('start_installation_date')->nullable();
            $table->dateTime('finish_installation_date')->nullable();
            $table->dateTime('training_date')->nullable();
            $table->date('warranty_start')->nullable();
            $table->date('warranty_end')->nullable();

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
        Schema::dropIfExists('pacs_installations');
    }
}
