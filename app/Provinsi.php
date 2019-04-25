<?php

namespace App;

use IlluminateDatabaseEloquentModel;

class Provinsi extends Model
{
    public $table = 'provinsi';
    protected $fillable = [
        'id','nama'
    ];
}