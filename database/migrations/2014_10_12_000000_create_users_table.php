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
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->string('phone')->nullable(false);
            $table->foreignId('gender_id')->nullable()->constrained('genders')->onDelete('set null');
            $table->string('email')->unique()->nullable()->default(null); // null is unique
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('account_type_id')->nullable()->constrained('account_types')->onDelete('set null'); // 0-admin 1-employee 2-user(any)
            // upload profile picture
            $table->string('dp')->nullable()->default("/img/profile.jpg");
            $table->timestamp("last_login")->default(date("Y-m-d H:i:s"));
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
