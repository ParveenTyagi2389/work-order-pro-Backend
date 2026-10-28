<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 40)->unique();
            $table->unsignedBigInteger('bill_to_id');
            $table->unsignedBigInteger('work_order_id')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('cc_email')->nullable();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->string('status', 30)->default('draft');
            $table->decimal('tax_rate', 7, 3)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->text('email_message')->nullable();
            $table->boolean('attach_pdf')->default(true);
            $table->boolean('send_reminder')->default(false);
            $table->timestamps();
            $table->foreign('bill_to_id')->references('id')->on('bill_tos')->restrictOnDelete()->cascadeOnUpdate();
            $table->index('work_order_id');
            $table->index(['status', 'invoice_date']);
        });
    }
    public function down(): void { Schema::dropIfExists('invoices'); }
};
