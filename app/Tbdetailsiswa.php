<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbdetailsiswa extends Model
{
    public $timestamps = false;

    public $primaryKey = 'idtbDetailSiswa';

    public $table = "tbdetailsiswa";

    protected $fillable = [
        'namaWali','pendidikanSiswa','jenjang','prodiSiswa','statusKomplit','idtbSiswa' 
    ];

}
