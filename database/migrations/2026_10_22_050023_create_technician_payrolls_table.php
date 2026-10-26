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
        Schema::create('technician_payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->dateTime('time_in_out');
            $table->boolean('authorized')->default(false);
            $table->boolean('paid')->default(false);
            $table->text('notes')->nullable();
            $table->boolean('paid_check')->default(false);
            $table->timestamps();
            $table->foreign('technician_id')->references('id')->on('technicians')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_payrolls');
    }
};
