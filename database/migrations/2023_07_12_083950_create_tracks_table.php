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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quote_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->float('accuracy', 10, 7);
            $table->float('speed')->nullable();
            $table->string('location');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tracks');
    }
};
