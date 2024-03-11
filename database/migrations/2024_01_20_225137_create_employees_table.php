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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number')->unique()->nullable(false);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('employee_type_id')->nullable()->constrained('employee_types')->onDelete('set null')->onUpdate('cascade');
            // $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->onUpdate('cascade');
            $table->integer('department_id')->default(0)->nullable()->unsigned();
            $table->boolean("deleted")->default(false);
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
