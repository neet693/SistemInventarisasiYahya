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
        Schema::table('barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_pengadaan_id')->nullable();

            // Definisi foreign key
            $table->foreign('jenis_pengadaan_id')
                ->references('id')
                ->on('jenis_pengadaans')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus barang jika jenis pengadaan dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['jenis_pengadaan_id']);
            $table->dropColumn('jenis_pengadaan_id');
        });
    }
};
