<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbdetailsiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbdetailsiswa', function (Blueprint $table) {
            $table->bigIncrements('idtbDetailSiswa');
            $table->string('namaWali')->nullable();
            $table->string('pendidikanSiswa')->nullable();
            $table->integer('jenjang')->nullable();
            $table->integer('tingkatPendidikan')->nullable();
            $table->longText('prodiSiswa')->nullable();
            $table->string('fotoProfile')->nullable();
            $table->integer('statusKomplit')->nullable();
            $table->unsignedBigInteger('idtbSiswa')->nullable();
            $table->foreign('idtbSiswa')->references('idtbSiswa')->on('tbsiswa');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbdetailsiswas');
    }
}
