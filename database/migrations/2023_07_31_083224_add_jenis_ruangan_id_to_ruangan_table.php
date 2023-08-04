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
        Schema::table('ruangans', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_ruangan_id')->nullable();

            // Definisi foreign key
            $table->foreign('jenis_ruangan_id')
                ->references('id')
                ->on('jenis_ruangans')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus ruangan jika jenis ruangan dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->dropForeign(['jenis_ruangan_id']);
            $table->dropColumn('jenis_ruangan_id');
        });
    }
};
