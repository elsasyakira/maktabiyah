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
        Schema::create('tausiyahs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Nama umat
            $table->string('holaqoh')->nullable(); // Nama halaqohnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tausiyahs');
    }
};
