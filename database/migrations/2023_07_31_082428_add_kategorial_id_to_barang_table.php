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
            // Change the data type of 'kategorial_id' to unsignedBigInteger
            $table->unsignedBigInteger('kategorial_id')->nullable();

            // Define the foreign key constraint
            $table->foreign('kategorial_id')
                ->references('id')
                ->on('kategorials')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['kategorial_id']);
            $table->dropColumn('kategorial_id');
        });
    }
};
