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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quote_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('driver_info')->nullable();
            $table->string('truck_num');
            $table->string('truck_type');
            $table->string('truck_capacity');
            $table->string('miles');
            $table->tinyInteger('active');
            $table->string('verify_code');
            $table->rememberToken();
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
        Schema::dropIfExists('drivers');
    }
};
