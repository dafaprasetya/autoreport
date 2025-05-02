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
        Schema::table('report_its', function (Blueprint $table) {
            $table->string('status')->default('Belum Selesai')->after('foto_after');
        });
        Schema::table('report_services', function (Blueprint $table) {
            $table->string('status')->default('Belum Selesai')->after('foto_after');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_its', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('report_services', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
