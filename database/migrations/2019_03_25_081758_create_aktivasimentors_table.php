<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktivasimentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivasimentor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NoIDMentor')->unique();
            $table->timestamp('tglAktivasi')->nullable();
            $table->timestamp('limitAktivasi')->nullable();
            $table->string('codeAktivasi')->nullable();
            $table->integer('statusLimit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktivasimentors');
    }
}
