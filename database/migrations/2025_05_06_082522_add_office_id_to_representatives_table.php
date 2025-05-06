<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('representatives', function (Blueprint $table) {
            $table->foreignId('office_id')->after('id')->constrained('offices')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('representatives', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropColumn('office_id');
        });
    }
};
