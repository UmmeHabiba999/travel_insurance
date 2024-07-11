<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('card_number');
            $table->date('expiration_date');
            $table->integer('cvc');
            $table->string('payment_address');
            $table->string('payment_city');
            $table->integer('payment_zip_code');
            $table->string('payment_country');
            $table->string('payment_state_of_residence');
            $table->string('billing_address')->comment('1 => yes, 0 => no')->default(0);
            $table->string('promotional_info')->comment('1 => yes, 0 => no')->default(0);
            $table->string('terms_conditions')->comment('1 => yes, 0 => no')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
