<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolymorphToPacsEngineersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacs_engineers', function (Blueprint $table) {
            $table->unsignedBigInteger('engineerable_id')->after('id');
            $table->string('engineerable_type')->after('engineerable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacs_engineers', function (Blueprint $table) {
            //
        });
    }
}
