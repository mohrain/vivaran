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
        //
            Schema::create('office_services', function (Blueprint $table) {
        $table->id();
        $table->foreignId('office_id')->constrained('offices')->onDelete('cascade');
        $table->foreignId('service_type_id')->constrained('service_types')->onDelete('cascade');
        $table->string('email')->nullable();
        $table->string('contact')->nullable();
        $table->string('status')->default('Active');
        $table->string('remark')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
