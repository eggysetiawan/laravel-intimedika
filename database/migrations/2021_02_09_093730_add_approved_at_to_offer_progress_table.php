<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedAtToOfferProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_progress', function (Blueprint $table) {
            $table->dateTime('approved_at')->nullable()->after('approval');
            $table->unsignedBigInteger('approved_by')->after('approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_progress', function (Blueprint $table) {
            //
        });
    }
}
