<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswabimbel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswabimbel', function (Blueprint $table) {
            $table->bigIncrements('idsiswaBimbel');
            $table->string('NoIDBimbel');
            $table->string('NoIDSiswa');            
            $table->integer('prodi');
            $table->string('NoIDTutor');
            $table->datetime('tglentry');
            $table->integer('status');
            $table->datetime('tglupdate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswabimbel');
    }
}
