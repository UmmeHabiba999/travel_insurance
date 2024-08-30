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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_id')->unique();
            $table->longText('quote_code');
            $table->decimal('price_after_discount_inc_tax', 10, 2);
            $table->string('currency')->default('EUR');
            $table->string('policy_holder_name');
            $table->string('policy_holder_email');
            $table->date('birth_date');
            $table->string('address');
            $table->string('consent_code');
            $table->boolean('is_payment_successful')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
