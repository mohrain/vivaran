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
        Schema::create('representatives', function (Blueprint $table) {
            $table->id();
            $table->string('representative_name')->nullable();
            $table->string('representative_phone')->nullable();
            $table->string('representative_ward')->nullable();
            $table->foreignId('post_category_id')->constrained('post_categories')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('representative_email')->nullable();
            $table->string('representative_address')->nullable();
            $table->string('representative_image')->nullable();
            $table->text('remark')->nullable();

            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
