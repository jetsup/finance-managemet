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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('reg_number')->unique()->nullable(false);
            $table->string('email')->unique()->nullable()->default(null); // null is unique
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('genders')->onDelete('set null');
            $table->date('date_of_birth')->nullable()->default(null);
            $table->date('admission_date')->nullable()->default(null);
            $table->integer('year_of_study')->nullable(false)->default(1);
            // student's picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
