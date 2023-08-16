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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama');
            $table->string('merk');
            $table->text('spesifikasi');
            $table->text('catatan')->nullable();
            $table->year('tahun')->nullable();
            $table->enum('kondisi', ['Baik', 'Rusak', 'Butuh Perbaikan'])->default('Baik');
            $table->integer('jumlah');
            $table->string('sumber_peroleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
