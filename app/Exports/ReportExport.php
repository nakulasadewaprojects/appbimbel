<?php

namespace App\Exports;

use App\hasilpembelajaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return hasilpembelajaran::all();
    // }
    use Exportable;

    public function __construct(int $yeara)
    {
        $this->year = $yeara;
    }

    public function query()
    {
        // return hasilpembelajaran::query()->where('IdSiswa', 123)->orWhere('IdSiswa', 456);
        return hasilpembelajaran::query()->whereYear('TglBimbel', 2019);
    }
}
