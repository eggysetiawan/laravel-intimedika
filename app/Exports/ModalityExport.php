<?php

namespace App\Exports;

use App\Modality;
use Maatwebsite\Excel\Concerns\FromCollection;

class ModalityExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Modality::all();
    }
}
