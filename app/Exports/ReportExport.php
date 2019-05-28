<?php

namespace App\Exports;

use App\hasilpembelajaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;



class ReportExport implements FromQuery
{
    use Exportable;

    public function TglBimbel($year,$end,$siswa,$matpel,$kode)
    {
        $this->year = $year;
        $this->end = $end;
        $this->siswa = $siswa;
        $this->matpel = $matpel;
        $this->kode = $kode;
        
        return $this;
    }

    public function query()
    {
        if($this->kode=='1'){
            return hasilpembelajaran::query()->whereBetween('TglBimbel', [$this->year,$this->end]);
        }
        elseif($this->kode=='2'){
            return hasilpembelajaran::query()->whereBetween('TglBimbel', [$this->year,$this->end])->where('IdSiswa',$this->siswa);
        }
        elseif($this->kode=='3'){
            return hasilpembelajaran::query()->whereBetween('TglBimbel', [$this->year,$this->end])->where('MatPel',$this->matpel);
        }
        elseif($this->kode=='4'){
            return hasilpembelajaran::query()->whereBetween('TglBimbel', [$this->year,$this->end])->where('IdSiswa',$this->siswa)->where('MatPel',$this->matpel);
        }
    }
}
