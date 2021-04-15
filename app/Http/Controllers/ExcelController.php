<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Exports\OfferExport;
use App\Exports\HospitalExport;
use App\Exports\ModalityExport;
use App\Exports\VisitExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function theTime()
    {
        return date('Ymd_His');
    }
    public function offer()
    {
        return Excel::download(new OfferExport, 'IPI_Penawaran_' . $this->theTime() . '.xlsx');
    }

    public function hospital()
    {
        return Excel::download(new HospitalExport, 'IPI_Hospital_' . uniqid() . '.xlsx');
    }

    public function customer()
    {
        return Excel::download(new CustomerExport, 'IPI_Customer_' . uniqid() . '.xlsx');
    }

    public function visit()
    {
        return Excel::download(new VisitExport, 'IPI_Kunjungan_' . uniqid() . '.xlsx');
    }

    public function modality()
    {
        return Excel::download(new ModalityExport, 'IPI_Modality_' . uniqid() . '.xlsx');
    }
}
