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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('office_id')->nullable()->after('id');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['office_id']);
             $table->dropColumn('office_id');
        });
    }
};
