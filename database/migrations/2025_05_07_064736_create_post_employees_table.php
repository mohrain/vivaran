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
        Schema::create('post_employees', function (Blueprint $table) {

            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('post_employee')->nullable();
            $table->string('employee_status')->default('active')->nullable();
            $table->foreignId('office_id')->nullable()->constrained('offices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_employees');
    }
};
