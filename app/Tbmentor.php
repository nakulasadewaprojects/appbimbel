<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tbmentor extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $timestamps = false;

    public $primaryKey = 'idmentor';

    public $table = "tbmentor";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NoIDMentor','username','nm_depan','nm_belakang', 'gender', 'email', 'password','tglregister','statusAktivasi','statusTutor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'statusAktivasi' => 'boolean',
    ];
}
