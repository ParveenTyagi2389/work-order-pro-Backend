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
        Schema::create('bill_to_emails', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('bill_to');
            $table->string('bill_email')->nullable();
            $table->string('bill_name')->nullable();
            $table->boolean('bill_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_to_emails');
    }
};
