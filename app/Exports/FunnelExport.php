<?php

namespace App\Exports;

use App\Funnel;
use Maatwebsite\Excel\Concerns\FromCollection;

class FunnelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Funnel::all();
    }
}
