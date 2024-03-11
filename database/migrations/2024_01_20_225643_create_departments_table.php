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
        /**
         * Departments are used in budgeting and in the allocation of resources.
         */
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->longText('description')->nullable()->default("Department description");
            $table->foreignId('head_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
