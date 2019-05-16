<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSceduletutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sceduletutor', function (Blueprint $table) {
            $table->bigIncrements('idsceduleTutor');
            $table->string('days');            
            $table->time('start');
            $table->time('end');
            $table->date('tglprivate');
            $table->date('tglupdate');
            $table->integer('status');
            $table->string('NoIDBimbel');            
            $table->string('NoScheduleTutor');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sceduletutor');
    }
}
