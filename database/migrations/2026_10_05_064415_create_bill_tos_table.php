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
        Schema::create('bill_tos', function (Blueprint $table) {
            $table->id();
            $table->decimal('bill_travel', 10, 2)->nullable();
            $table->decimal('bill_labor', 10, 2)->nullable();
            $table->decimal('bill_fuel', 10, 2)->nullable();
            $table->string('bill_name')->nullable();
            $table->string('bill_address')->nullable();
            $table->string('bill_account')->nullable();
            $table->string('bill_po')->nullable();
            $table->string('bill_city')->nullable();
            $table->string('bill_state', 2)->nullable();
            $table->string('bill_zip', 10)->nullable();
            $table->string('bill_phone', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_tos');
    }
};
