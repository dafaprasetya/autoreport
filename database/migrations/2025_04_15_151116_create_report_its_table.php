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
        Schema::create('report_its', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('keterangan');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('deskripsi_pekerjaan');
            $table->unsignedBigInteger('divisi_id');
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_pekerjaan_id');
            $table->foreign('jenis_pekerjaan_id')->references('id')->on('jenis_pekerjaans')->onDelete('cascade');
            $table->unsignedBigInteger('lokasi_id');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('lead_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_its');
    }
};
