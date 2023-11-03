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
        Schema::create('purchase_store_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->foreignId('purchase_id');
            $table->foreignId('store_item_id');
            $table->double('qty');
            $table->double('rate');
            $table->double('amount');
            $table->double('received');
            $table->double('discount')->nullable();
            $table->double('tax_rate')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('total_amount');
            $table->double('unit_qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
