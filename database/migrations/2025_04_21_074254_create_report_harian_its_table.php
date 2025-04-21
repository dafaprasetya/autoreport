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
        Schema::create('report_harian_its', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->text('agenda')->nullable();
            $table->unsignedBigInteger('kategori_harian_id')->nullable();
            $table->foreign('kategori_harian_id')->references('id')->on('kategori_harians')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default('Belum Selesai');
            $table->text('detail_kerja')->nullable();
            $table->integer('poin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_harian_its');
    }
};
