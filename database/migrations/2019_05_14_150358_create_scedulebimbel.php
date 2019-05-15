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
            $table->string('NoIDBimbel');
            $table->integer('durasi');
            $table->datetime('startBimbel');
            $table->datetime('endBimbel');
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
