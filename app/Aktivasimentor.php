<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktivasimentor extends Model
{

    public $timestamps = false;

    public $table = "aktivasimentor";

    protected $fillable = [
        'NoIDMentor','tglAktivasi','limitAktivasi','codeAktivasi', 'statusLimit'
    ];

    protected $casts = [
        'tglAktivasi' => 'datetime',
    ];
}
