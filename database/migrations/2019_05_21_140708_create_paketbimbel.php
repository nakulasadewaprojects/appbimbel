<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketbimbel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paketbimbel', function (Blueprint $table) {
            $table->bigIncrements('idpaket');
            $table->string('NoIDMentor')->nullable();
            $table->string('nmpaket')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('durasi')->nullable();
            $table->text('hari')->nullable();
            $table->time('wkt_mulai')->nullable();
            $table->time('wkt_akhir')->nullable();
            $table->text('matpel')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('statusPaket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paketbimbel');
    }
}
