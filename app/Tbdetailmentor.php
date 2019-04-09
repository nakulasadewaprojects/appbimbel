<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbdetailmentor extends Model
{
    public $timestamps = false;    

    public $primaryKey = 'idtbRiwayatTutor';

    public $table = "tbdetailmentor";

    protected $fillable = [
        'idtbRiwayatTutor','pendidikanTerakhir','statusPendidikan','foto', 'No_Identitas','fileKTP','fileIjazah','statKomplit','idmentor','pengalaman'
    ];

}
