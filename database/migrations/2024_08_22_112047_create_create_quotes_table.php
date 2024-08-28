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
        Schema::create('create_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->string('name');
            $table->longText('quote_code');
            $table->decimal('price_after_discount_incl_tax',10,2);
            $table->decimal('premium_after_discount_excl_tax',10,2);
            $table->string('consent');
            $table->string('content_url');
            $table->string('trip_cancallation');
            $table->string('trip_interuption');
            $table->string('medical_expenses');
            $table->string('emergency_evacuation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_quotes');
    }
};
