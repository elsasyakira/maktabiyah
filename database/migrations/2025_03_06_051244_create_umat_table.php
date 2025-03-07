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
        Schema::create('umat', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nas');
            $table->enum('syubah', ['AshShidiqqin', 'AsySyuhada', 'AshSholihin', 'AlMutaqien', 'AlMuhsinin', 'AshShobirin']);
            $table->integer('holaqoh');
            $table->integer('farah');
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
        Schema::dropIfExists('umat');
    }
};
