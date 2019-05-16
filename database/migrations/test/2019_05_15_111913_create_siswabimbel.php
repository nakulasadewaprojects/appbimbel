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
            $table->string('NoIDBimbel')->nullable();
            $table->string('NoIDSiswa')->nullable();            
            $table->string('prodi')->nullable();
            $table->string('NoIDTutor')->nullable();
            $table->datetime('tglentry')->nullable();
            $table->integer('statusBimbel')->nullable();
            $table->datetime('tglupdate')->nullable();
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
