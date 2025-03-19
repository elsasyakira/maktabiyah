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
        Schema::table('tausiyahs', function (Blueprint $table) {
            $table->unsignedBigInteger('umat_id')->after('id');
            $table->foreign('umat_id')->references('id')->on('umats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tausiyahs', function (Blueprint $table) {
            $table->dropForeign(['umat_id']);
            $table->dropColumn('umat_id');
        });
    }
};
