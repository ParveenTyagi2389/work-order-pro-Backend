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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
            $table->dateTime('job_created_at')->nullable();
            $table->foreignId('technician_id')->nullable()->constrained('technicians')->nullOnDelete();
            $table->foreignId('job_code_id')->nullable()->constrained('job_codes')->nullOnDelete();
            $table->string('customer_work_order', 100)->nullable();
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->decimal('override_travel', 10, 2)->nullable();
            $table->decimal('override_labor', 10, 2)->nullable();
            $table->boolean('fuel_reimbursement')->default(false);
            $table->boolean('serviced')->default(false);
            $table->boolean('billed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
