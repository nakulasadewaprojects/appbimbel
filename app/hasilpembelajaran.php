<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hasilpembelajaran extends Model
{
    public $timestamps = false;    
    protected $table = 'hasilpembelajaran';
    protected $primaryKey = 'idhasilpembelajaran';
    protected $fillable = [
        'idhasilpembelajaran','no_id','IdMentor','IdSiswa', 'created_at','TglBimbel','wkt_mulai','wkt_selesai','MatPel','ModulMatpel','Aktifitas','Catatan'
    ];

    public function tbsiswa()
{
    return $this->belongsTo('App\Tbsiswa', 'NoIDSiswa', 'Idsiswa');
}

}
