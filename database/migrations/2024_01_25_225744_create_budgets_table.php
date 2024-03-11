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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("department_id")->nullable()->constrained("departments")->onDelete("set null");
            $table->string("project_name"); // this is the name of the project under which this budget falls under
            $table->bigInteger("allocated_amount");
            $table->timestamp("allocation_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
