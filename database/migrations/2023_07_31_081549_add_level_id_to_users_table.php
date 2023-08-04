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
            // $table->foreignId('level_id')->constrained('levels');
            $table->unsignedBigInteger('level_id')->nullable();

            // Definisi foreign key
            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('set null'); // Atur sesuai kebutuhan, misalnya 'cascade' jika ingin menghapus user jika level dihapus.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropColumn('level_id');
        });
    }
};
