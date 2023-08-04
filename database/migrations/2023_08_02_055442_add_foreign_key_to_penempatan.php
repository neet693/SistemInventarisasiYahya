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
        Schema::table('penempatans', function (Blueprint $table) {
            // Tambahkan kolom 'jenis_ruangan_id' dengan tipe data unsignedBigInteger
            $table->unsignedBigInteger('jenis_ruangan_id')->nullable();

            // Tambahkan kolom 'barang_id' dengan tipe data unsignedBigInteger
            $table->unsignedBigInteger('barang_id')->nullable();

            // Tambahkan kolom 'kode_ruangan' dengan tipe data string
            $table->string('kode_ruangan')->nullable();

            // Definisi foreign key untuk 'jenis_ruangan_id'
            $table->foreign('jenis_ruangan_id')
                ->references('id')
                ->on('jenis_ruangans')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus penempatan jika jenis ruangan dihapus.

            // Definisi foreign key untuk 'barang_id'
            $table->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus penempatan jika barang dihapus.

            // Definisi foreign key untuk 'kode_ruangan'
            $table->foreign('kode_ruangan')
                ->references('kode_ruangan')
                ->on('ruangans')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus penempatan jika ruangan dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penempatans', function (Blueprint $table) {
            //
        });
    }
};
