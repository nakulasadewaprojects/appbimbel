<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbmentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbmentor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NoIDMentor',15)->nullable();
            $table->string('username',35)->unique();
            $table->string('password');
            $table->string('nm_depan',100);
            $table->string('nm_belakang',100)->nullable();
            $table->string('alamat',100)->nullable();
            $table->integer('provinsi')->nullable();
            $table->integer('kota')->nullable();
            $table->integer('kecamatan')->nullable();
            $table->integer('kelurahan')->nullable();
            $table->string('noTlpn',15)->nullable();
            $table->integer('statusTutor')->nullable();
            $table->string('gender')->nullable();
            $table->string('email',100)->unique();
            $table->timestamp('tglregister')->nullable();
            $table->integer('statusAktivasi')->nullable();
            $table->rememberToken()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbmentors');
    }
}
