<?php

namespace App\Exports;

use App\Hospital;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hospital::all();
    }
}
