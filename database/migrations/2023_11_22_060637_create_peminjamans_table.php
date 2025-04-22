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
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // Menambahkan kolom unit
            $table->foreignId('barang_id')->constrained()->onDelete('cascade'); // Foreign key untuk barang
            $table->string('nama_peminjam');
            $table->string('nama_asesor');
            $table->string('nama_penerima')->nullable();
            $table->datetime('tanggal_pinjam');
            $table->datetime('tanggal_kembali')->nullable();
            $table->enum('acc_peminjaman', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_tidak_acc')->nullable();
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
