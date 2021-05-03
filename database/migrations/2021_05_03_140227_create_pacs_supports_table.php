<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacsSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacs_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pacs_installation_id')->constrained('pacs_installations')->cascadeOnDelete();
            $table->string('hospital_personel')->nullable();
            $table->dateTime('report_date');
            $table->text('problem');
            $table->text('solve');
            $table->dateTime('solve_date');
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
        Schema::dropIfExists('pacs_supports');
    }
}
