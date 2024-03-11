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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('transaction_date')->nullable(false);
            $table->foreignId('transaction_type_id')->nullable()->constrained('transaction_types')->onDelete('set null');
            $table->foreignId('from_account_id')->nullable()->constrained('bank_accounts')->onDelete('set null');
            $table->foreignId('to_account_id')->nullable()->constrained('bank_accounts')->onDelete('set null');
            $table->unsignedFloat('amount', 10)->nullable(false);
            $table->string("transaction_code")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
