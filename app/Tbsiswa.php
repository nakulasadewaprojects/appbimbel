<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tbsiswa extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    // protected $guard = 'siswaguard';

    // public $primaryKey = 'NoIDSiswa';

    public $table = "tbsiswa";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NoIDSiswa','username','password','NamaLengkap', 'gender','NoTlpn', 'email','status', 'tglregister'
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
//    protected $casts = [
//        // 'email_verified_at' => 'datetime',
//        'statusAktivasi' => 'boolean',
//    ];
}
