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
        Schema::create('ruangans', function (Blueprint $table) {
            // $table->string('kode_ruangan')->primary();
            $table->id();
            // $table->foreignId('jenis_ruangan_id')->constrained('jenis_ruangans', 'id')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
        Schema::table('ruangans', function (Blueprint $table) {
            $table->dropIndex(['kode_ruangan']);
        });
    }
};
