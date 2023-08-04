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
        Schema::create('status_perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket_perbaikan')->nullable();
            $table->date('tanggal_selesai');
            $table->enum('kondisi', ['Baik', 'Rusak', 'Butuh Perbaikan'])->default('Baik');
            $table->text('keterangan');
            $table->timestamps();
            // Define the foreign key constraint
            $table->foreign('no_tiket_perbaikan')
                ->references('no_tiket_perbaikan')
                ->on('perbaikans')
                ->onDelete('cascade'); // Use 'cascade' if you want to delete the corresponding status when the related Perbaikan is deleted.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_perbaikans');
    }
};
