<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbdetailmentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbdetailmentor', function (Blueprint $table) {
            $table->bigIncrements('idtbRiwayatTutor');
            $table->integer('pendidikanTerakhir')->nullable();
            $table->integer('statusPendidikan')->nullable();
            $table->string('foto')->nullable();
            $table->string('No_Identitas')->nullable();
            $table->string('fileKTP')->nullable();
            $table->string('fileIjazah')->nullable();
            $table->integer('statKomplit')->nullable();
            $table->unsignedBigInteger('idmentor')->nullable();
            $table->foreign('idmentor')->references('idmentor')->on('tbmentor');
            $table->text('pengalaman')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbdetailmentors');
    }
}
