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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket_peminjaman')->unique();
            $table->date('tanggal_pinjam');
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('penerima_id')->nullable()->constrained('users');
            $table->string('nama_peminjam');
            $table->integer('jumlah');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status_peminjaman', ['Dipinjamkan', 'Dikembalikan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
