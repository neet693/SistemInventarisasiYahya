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
        Schema::create('pemindahan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('unit_asal_id')->constrained('units');
            $table->foreignId('unit_tujuan_id')->constrained('units');
            $table->foreignId('ruangan_asal_id')->constrained('ruangans');
            $table->foreignId('ruangan_tujuan_id')->constrained('ruangans');
            $table->datetime('tanggal_pemindahan');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemindahan_barangs');
    }
};
