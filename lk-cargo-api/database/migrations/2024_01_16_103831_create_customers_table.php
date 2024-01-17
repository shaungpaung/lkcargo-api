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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', config('enums.type'));
            $table->string('nrc');
            $table->string('phone');
            $table->string('phone_number')->nullable()->default('');
            $table->string('address');
            $table->string('business_name')->nullable()->default('');
            $table->enum('payment_type', config('enums.payment_type'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
