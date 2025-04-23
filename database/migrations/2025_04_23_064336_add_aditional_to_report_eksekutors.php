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
        Schema::table('report_eksekutors', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_harian_id')->nullable()->after('deskripsi_pekerjaan');
            $table->foreign('kategori_harian_id')->references('id')->on('kategori_harians')->onDelete('cascade');
            $table->unsignedBigInteger('divisi_id')->nullable()->after('kategori_harian_id');
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_pekerjaan_id')->nullable()->after('divisi_id');
            $table->foreign('jenis_pekerjaan_id')->references('id')->on('jenis_pekerjaans')->onDelete('cascade');
            $table->unsignedBigInteger('lokasi_id')->nullable()->after('jenis_pekerjaan_id');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_eksekutors', function (Blueprint $table) {
            //
        });
    }
};
