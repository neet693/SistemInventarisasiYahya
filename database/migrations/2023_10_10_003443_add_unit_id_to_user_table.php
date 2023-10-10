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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable();

            // Definisi foreign key
            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus barang jika jenis pengadaan dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
