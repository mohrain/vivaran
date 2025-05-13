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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name')->unique();
            $table->string('office_email')->unique();
            $table->string('office_phone')->unique();
            $table->string('office_address')->nullable();
            $table->string('office_code')->nullable();
            $table->string('office_logo')->nullable();
            $table->text('office_description')->nullable();
            $table->foreignId('office_category_id')->constrained('office_categories')->onDelete('cascade');
            $table-> foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
