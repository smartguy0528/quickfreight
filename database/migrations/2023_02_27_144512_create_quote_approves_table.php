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
        Schema::create('quote_approves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quote_requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('cost', 7, 2);
            $table->decimal('fee', 7, 2);
            $table->decimal('total_cost', 7, 2);
            $table->text('company_comment')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->text('reject_reason')->nullable();
            $table->decimal('old_cost', 7, 2)->nullable();
            $table->decimal('old_fee', 7, 2)->nullable();
            $table->decimal('old_total_cost', 7, 2)->nullable();
            $table->text('old_company_comment')->nullable();
            $table->text('old_reject_reason')->nullable();
            $table->text('del_reason')->nullable();
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
        Schema::dropIfExists('quote_approves');
    }
};
