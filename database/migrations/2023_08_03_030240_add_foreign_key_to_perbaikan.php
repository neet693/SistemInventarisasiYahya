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
        Schema::table('perbaikans', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->string('kode_ruangan')->nullable();
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
        Schema::table('perbaikans', function (Blueprint $table) {
            //
        });
    }
};
