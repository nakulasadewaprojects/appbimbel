<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilpembelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasilpembelajaran', function (Blueprint $table) {
            $table->bigIncrements('idhasilpembelajaran');
            $table->string('no_id')->nullable();            
            $table->string('IdMentor')->nullable();            
            $table->string('IdSiswa')->nullable();            
            $table->datetime('created_at')->nullable(); 
            $table->date('TglBimbel')->nullable(); 
            $table->time('wkt_mulai')->nullable(); 
            $table->time('wkt_selesai')->nullable(); 
            $table->text('MatPel')->nullable(); 
            $table->string('ModulMatpel')->nullable(); 
            $table->text('Aktifitas')->nullable(); 
            $table->text('Catatan')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasilpembelajaran');
    }
}
