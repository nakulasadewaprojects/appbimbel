<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswabimbel extends Model
{
    public $timestamps = false;    

    public $primaryKey = 'idsiswaBimbel';

    public $table = "siswabimbel";

    protected $fillable = [
        'idsiswaBimbel','NoIDBimbel','NoIDSiswa','prodi','NoIDTutor','tglentry','status','tglupdate'
    ];

}
