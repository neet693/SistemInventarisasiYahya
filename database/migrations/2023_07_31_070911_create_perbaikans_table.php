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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket_perbaikan')->unique();
            $table->date('tanggal_kerusakan');
            $table->text('keterangan');
            $table->string('penanggung_jawab');
            $table->enum('status', ['Rusak Ringan', 'Rusak Berat'])->default('Rusak Ringan');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
