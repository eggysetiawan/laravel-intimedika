<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneRadiologyToPacsStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacs_stakeholders', function (Blueprint $table) {
            $table->string('phone_radiology')->after('radiology_name')->nullable();
            $table->longText('user_note')->after('email_radiology')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacs_stakeholders', function (Blueprint $table) {
            //
        });
    }
}
