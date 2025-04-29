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
        Schema::create('report_harian_it_news', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('agenda');
            $table->unsignedBigInteger('kategori_harian_id')->nullable();
            $table->foreign('kategori_harian_id')->references('id')->on('kategori_harian_news')->onDelete('cascade');
            $table->date('tanggal_penugasan')->nullable();
            $table->date('target_selesai')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('detail_kerja')->nullable();
            $table->string('status')->nullable();
            $table->text('note_progres')->nullable();
            $table->unsignedBigInteger('report_eksekutor_id')->nullable();
            $table->foreign('report_eksekutor_id')->references('id')->on('report_eksekutors')->onDelete('cascade');
            $table->enum('overtime', ['yes', 'no'])->default('no');
            $table->unsignedBigInteger('dibuatOleh')->nullable();
            $table->foreign('dibuatOleh')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_harian_it_news');
    }
};
