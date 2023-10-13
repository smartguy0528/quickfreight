<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('id_alias')->nullable();
            // $table->string('pickup');
            $table->string('location');
            // $table->dateTime('pickupDate');
            // $table->dateTime('deliveryDate');
            $table->string('commodity')->nullable();
            $table->string('dimension')->nullable();
            $table->dateTime('dateData')->nullable();
            $table->string('selectLoad');
            // $table->string('weight')->nullable();
            // $table->string('temperature')->nullable();
            // $table->tinyInteger('equipment');
            // $table->tinyInteger('trailerSize');
            // $table->tinyText('comment')->nullable();
            // $table->tinyInteger('status')->nullable();
            // $table->tinyInteger('payment_status')->nullable();
            // $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('quote_service_requests');
    }
};
