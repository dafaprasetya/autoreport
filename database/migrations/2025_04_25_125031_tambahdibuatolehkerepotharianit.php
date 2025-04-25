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
        Schema::table('report_harian_its', function (Blueprint $table) {
            $table->unsignedBigInteger('dibuatOleh')->nullable()->after('poin');
            $table->foreign('dibuatOleh')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_harian_its', function (Blueprint $table) {
            //
        });
    }
};
