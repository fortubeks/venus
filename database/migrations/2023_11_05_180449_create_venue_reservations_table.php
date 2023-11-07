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
        Schema::create('venue_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id');
            $table->foreignId('room_id');
            $table->foreignId('user_id');
            $table->foreignId('hotel_id');
            $table->timestamp('checkin_date')->nullable();
            $table->timestamp('checkout_date')->nullable();
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_reservations');
    }
};
