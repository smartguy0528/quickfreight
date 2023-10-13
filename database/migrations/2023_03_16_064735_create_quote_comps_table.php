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
        Schema::create('quote_comps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quote_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('deliver_cost', 7, 2)->nullable();
            $table->text('company_carrier_comment')->nullable();
            $table->string('doc_carrier_packet')->nullable();
            $table->string('doc_cert_ins')->nullable();
            $table->string('doc_w9_form')->nullable();
            $table->string('doc_operating_auth')->nullable();
            $table->string('company_sign')->nullable();
            $table->string('carrier_sign')->nullable();
            $table->text('carrier_comment')->nullable();
            $table->text('customer_review')->nullable();
            $table->boolean('disp_review')->nullable();
            $table->tinyInteger('star_review')->nullable();
            $table->string('bol_path')->nullable();
            $table->string('location')->nullable();
            $table->decimal('lat', 8, 5)->nullable();
            $table->decimal('long', 8, 5)->nullable();
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
        Schema::dropIfExists('quote_comps');
    }
};
