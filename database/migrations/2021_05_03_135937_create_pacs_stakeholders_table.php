<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacsStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacs_stakeholders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pacs_installation_id')->constrained('pacs_installations')->cascadeOnDelete();
            $table->string('radiology_name')->nullable();
            $table->string('radiographer_name')->nullable();
            $table->string('it_hospital_name')->nullable();
            $table->string('phone_it')->nullable();
            $table->string('email_it')->nullable();
            $table->string('phone_radiographer')->nullable();
            $table->string('email_radiographer')->nullable();
            $table->string('email_radiology')->nullable();
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
        Schema::dropIfExists('pacs_stakeholders');
    }
}
