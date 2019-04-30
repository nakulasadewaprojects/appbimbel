<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbtingkatpendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbtingkatpendidikan', function (Blueprint $table) {
            $table->bigIncrements('idtingkat');
            $table->integer('tingkat')->nullable;
            $table->string('keterangan', 255)->nullable;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbtingkatpendidikan');
    }
}
