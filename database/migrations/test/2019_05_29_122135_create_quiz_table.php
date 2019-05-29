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
            $table->string('NoIDMentor',15)->nullable();
            $table->string('NoIDSiswa',15)->nullable();
            $table->date('tglquiz')->nullable();
            $table->string('MatPel', 45)->nullable();
            $table->string('modul', 100)->nullable();
            $table->integer('nilai')->nullable();
            $table->text('catatan')->nullable();

            

            
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
