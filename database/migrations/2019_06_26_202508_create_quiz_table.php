<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->bigIncrements('idquiz');
            $table->string('NoIdMentor')->nullable();            
            $table->datetime('created_at')->nullable();            
            $table->string('judul')->nullable();            
            $table->string('filequiz')->nullable();            
            $table->string('diskripsi')->nullable();       
//            $table->integer('status_video')->comment('1=publish 2=non publish')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
