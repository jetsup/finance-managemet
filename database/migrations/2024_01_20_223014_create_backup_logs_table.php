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
        Schema::create('backup_logs', function (Blueprint $table) {
            $table->id();
            $table->string('backup_name')->nullable(false);
            // $table->string('backup_type')->nullable(false); // full, partial
            $table->string('backup_path')->nullable(false);
            $table->string('backup_size')->nullable(false);
            // $table->string('backup_status')->nullable(false); // success, failed, aborted
            $table->string('backup_message')->nullable(false);
            $table->timestamp('backup_date')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_logs');
    }
};