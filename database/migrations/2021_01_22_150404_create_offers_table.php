<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('user_id')->constrained('users');
            $table->string('offer_no');
            $table->string('slug');
            $table->string('budget', 10);
            $table->dateTime('offer_date')->nullable();
            $table->longText('price_note')->nullable();
            $table->string('warranty_note', 50)->nullable();
            $table->longText('availability_note')->nullable();
            $table->longText('payment_note')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('is_approved', 1)->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
