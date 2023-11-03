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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->string('status');
            $table->date('purchase_date');
            $table->double('amount');
            $table->double('discount')->nullable();
            $table->double('tax_rate')->nullable();
            $table->double('tax_amount')->nullable();
            $table->double('total_amount');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
