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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('state_of_residence');
            $table->string('destination_country');
            $table->date('departure_date');
            $table->date('return_date');
            $table->date('first_deposit_date');
            $table->integer('total_trip_cost');
            $table->integer('number_of_travelers');
            $table->integer('age_of_travelers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
