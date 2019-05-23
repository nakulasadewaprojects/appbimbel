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
            $table->string('days')->nullable();            
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->date('tglprivate')->nullable();
            $table->date('tglupdate')->nullable();
            $table->integer('statusSchedule')->nullable();
            $table->string('NoIDBimbel')->nullable();            
            $table->string('NoScheduleTutor')->nullable();            
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
