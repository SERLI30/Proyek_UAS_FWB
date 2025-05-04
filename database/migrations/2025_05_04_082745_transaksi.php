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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['cod'])->default('cod');
            $table->timestamps();
        
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('transaksi');
    }
};