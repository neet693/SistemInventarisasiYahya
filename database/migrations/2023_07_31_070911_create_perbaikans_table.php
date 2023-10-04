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
            $table->foreignId('barang_id')->constrained('barangs', 'id')->onDelete('cascade');
            $table->string('kode_ruangan')->nullable();
            $table->string('no_tiket_perbaikan')->unique();
            $table->date('tanggal_kerusakan');
            $table->text('keterangan');
            $table->string('penanggung_jawab');
            $table->boolean('is_selesai')->default(false);
            $table->enum('status', ['Urgent', 'Quite Urgent', 'Not Urgent'])->default('Not Urgent');
            $table->integer('jumlah_perbaikan');
            $table->timestamps();

            $table->foreign('kode_ruangan')
                ->references('kode_ruangan')
                ->on('ruangans')
                ->onDelete('set null');
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
