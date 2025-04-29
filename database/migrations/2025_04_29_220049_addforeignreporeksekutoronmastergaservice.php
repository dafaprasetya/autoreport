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
            $table->unsignedBigInteger('report_eksekutor_id')->nullable();
            $table->foreign('report_eksekutor_id')->references('id')->on('report_eksekutors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_it', function (Blueprint $table) {
            //
        });
    }
};
