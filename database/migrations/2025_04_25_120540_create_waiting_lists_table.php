<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waiting_lists', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('keluhan');
            $table->string('divisi');
            $table->string('foto_keluhan')->nullable();
            $table->string('kategori');
            $table->string('status');
            $table->unsignedBigInteger('dibuatOleh');
            $table->foreign('dibuatOleh')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_lists');
    }
};
