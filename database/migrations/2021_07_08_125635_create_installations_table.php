<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('modality_id');
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('sn', 50);
            $table->date('date')->nullable();
            $table->boolean('is_installed', 1)->nullable();
            $table->boolean('is_tested', 1)->nullable();
            $table->boolean('is_trained', 1)->nullable();
            $table->text('note')->nullable()->nullable();
            $table->text('pre_installation_note')->nullable();
            $table->string('reference', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installations');
    }
}
