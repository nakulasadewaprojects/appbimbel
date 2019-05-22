<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulsiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulsiswa', function (Blueprint $table) {
            $table->bigIncrements('idmodul');
            $table->string('nama_modul')->nullable();
            $table->datetime('tgl_upload')->nullable();
            $table->string('mentor')->nullable();
            $table->string('file')->nullable();
            $table->integer('jenjangpendidikan')->nullable();
            $table->integer('matpel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulsiswa');
    }
}
