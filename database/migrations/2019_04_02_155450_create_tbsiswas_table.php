<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbsiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbsiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NoIDSiswa',15)->nullable();
            $table->string('username',35)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('NamaLengkap',100)->nullable();
            $table->string('alamat',100)->nullable();
            $table->string('kota',45)->nullable();
            $table->string('provinsi',45)->nullable();
            $table->integer('kecamatan')->nullable();
            $table->integer('kelurahan')->nullable();
            $table->string('gender',11)->comment('1=laki-laki 2=perempuan')->nullable();
            $table->string('NoTlpn',15)->unique()->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->integer('status')->comment('1=aktif 2=non aktif 3=out')->nullable();
            $table->timestamp('tglregister')->nullable();
            $table->rememberToken()->nullable();
            // $table->string('password');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbsiswa');
    }
}
