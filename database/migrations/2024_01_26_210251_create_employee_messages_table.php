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
        Schema::create('employee_messages', function (Blueprint $table) {
            $table->id();
            // $table->foreignId("prev_msg_id")->default(0)->nullable()->unsigned()->constrained("employee_messages")->onDelete("set null")->onUpdate("cascade");
            $table->integer("prev_msg_id")->default(0)->nullable()->unsigned();
            $table->foreignId("for")->nullable()->unsigned()->constrained("employees")->onDelete("set null");
            $table->foreignId("from")->nullable()->unsigned()->constrained("employees")->onDelete("set null");
            $table->longText("message");
            $table->boolean("read")->default(false);
            $table->boolean("replied")->default(false);
            $table->boolean("deleted")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_messages');
    }
};
