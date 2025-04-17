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
        Schema::table('umats', function (Blueprint $table) {
            // Hapus kolom dulu
            $table->dropColumn('holaqoh');
        });

        Schema::table('umats', function (Blueprint $table) {
            // Tambahkan ulang dengan tipe string
            $table->string('holaqoh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('umats', function (Blueprint $table) {
            // Balik ke integer kalau di-rollback
            $table->dropColumn('holaqoh');
        });

        Schema::table('umats', function (Blueprint $table) {
            $table->integer('holaqoh')->nullable();
        });
    }
};
