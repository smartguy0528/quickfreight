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
        Schema::create('carriers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quote_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('dot_number');
            $table->string('legal_name');
            $table->string('dba_name')->nullable();
            $table->string('carrier_operation');
            $table->string('phy_street');
            $table->string('phy_city');
            $table->string('phy_state');
            $table->string('phy_zip');
            $table->string('phy_country');
            $table->string('telephone');
            $table->string('fax')->nullable();
            $table->string('email_address')->nullable();
            $table->string('mcs150_mileage');
            $table->date('mcs150_mileage_year')->format('Y')->nullable();
            $table->date('mcs150_date')->nullable();
            $table->date('add_date');
            $table->string('op_other');
            $table->string('verify_code')->nullable();
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
        Schema::dropIfExists('carriers');
    }
};
