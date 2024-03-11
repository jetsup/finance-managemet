<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->nullable()->constrained("employees")->onDelete("set null")->onUpdate("cascade");
            $table->integer("due_amount")->default(0);
            $table->integer("total_received")->default(0);
            /**
             * initially creted having a null value and will be updated once payment made to
             * avoid having another redundant table
             */
            $table->foreignId("transaction_id")->default(null)->nullable()->constrained("transactions")->onDelete("set null")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_payments');
    }
};
