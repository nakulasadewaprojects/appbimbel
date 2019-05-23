<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewmentorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewmentor', function (Blueprint $table) {
            $table->bigIncrements('idreview');
            $table->string('NoIDMentor')->nullable();            
            $table->datetime('created_at')->nullable();            
            $table->integer('nilai')->nullable();            
            $table->text('ulasan')->nullable();            
            $table->string('NoIdSiswa')->nullable();            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewmentor');
    }
}
