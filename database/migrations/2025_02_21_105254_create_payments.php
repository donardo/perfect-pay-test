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
            $table->string('payment_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_cpf');
            $table->string('customer_zipcode')->nullable();
            $table->string('customer_address_number')->nullable();
            $table->string('customer_phone')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->string('status');
            $table->json('payment_data')->nullable();
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
