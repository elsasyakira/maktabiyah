<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('bulan'); // Hapus kolom lama
        });

        Schema::table('absensis', function (Blueprint $table) {
            $table->enum('bulan', [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('bulan'); // Hapus kolom ENUM
            $table->integer('bulan')->nullable(); // Kembalikan ke tipe integer
        });
    }
};
