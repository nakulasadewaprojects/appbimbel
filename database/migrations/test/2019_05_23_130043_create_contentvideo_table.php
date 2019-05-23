<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentvideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contentvideo', function (Blueprint $table) {
            $table->bigIncrements('idcontent');
            $table->string('NoIdMentor')->nullable();            
            $table->datetime('created_at')->nullable();            
            $table->string('judul')->nullable();            
            $table->string('file')->nullable();            
            $table->string('diskripsi')->nullable();       
            $table->integer('status_video')->comment('1=publish 2=non publish')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contentvideo');
    }
}
