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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            // $table->foreignId("prev_complain_id")->default(0)->nullable()->unsigned()->constrained("complains")->onDelete("set null")->onUpdate("cascade");
            $table->integer("prev_complain_id")->default(0)->nullable()->unsigned();
            $table->foreignId("for")->nullable()->constrained("users")->onDelete("set null")->onUpdate("cascade");
            $table->foreignId("from")->nullable()->constrained("users")->onDelete("set null")->onUpdate("cascade");
            $table->string("subject")->nullable()->default("No Subject");
            $table->boolean("read")->default(false);
            $table->boolean("resolved")->default(false);
            $table->boolean("replied")->default(false);
            $table->longText("message");
            $table->boolean("deleted")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
