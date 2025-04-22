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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('penulis', 150);
            $table->string('penerbit', 150);
            $table->integer('tahun_terbit');
            $table->string('isbn', 20)->unique()->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->string('kategori', 50)->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('cover_buku', 255)->nullable();
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia');
            $table->string('lokasi_rak', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
