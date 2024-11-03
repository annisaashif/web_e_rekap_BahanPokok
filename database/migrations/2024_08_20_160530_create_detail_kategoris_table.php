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
        Schema::create('detail_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->references('id')->on('kategoris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kabupaten_id')->references('id')->on('kabupatens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal');
            $table->bigInteger('harga');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kategoris');
    }
};
