<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnydeskToPacsInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacs_installations', function (Blueprint $table) {
            $table->string('anydesk_server', 20)->after('user_id')->nullable();
            $table->string('anydesk_workstation', 20)->after('anydesk_server')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacs_installations', function (Blueprint $table) {
            //
        });
    }
}
