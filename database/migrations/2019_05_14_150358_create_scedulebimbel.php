<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScedulebimbel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scedulebimbel', function (Blueprint $table) {
            $table->bigIncrements('idsceduleBimbel');
            $table->string('NoIDBimbel')->nullable();
            $table->integer('durasi')->nullable();
            $table->datetime('startBimbel')->nullable();
            $table->datetime('endBimbel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scedulebimbel');
    }
}
