<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Exports\OfferExport;
use App\Exports\HospitalExport;
use App\Exports\ModalityExport;
use App\Exports\PacsReportExport;
use App\Exports\PacsReportMultiSheetExport;
use App\Exports\VisitExport;
use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function theTime()
    {
        return date('Ymd_His');
    }
    public function offer()
    {
        return $this->excel->download(new OfferExport, 'IPI_Penawaran_' . $this->theTime() . '.xlsx');
    }

    public function hospital()
    {
        return $this->excel->download(new HospitalExport, 'IPI_Hospital_' . uniqid() . '.xlsx');
    }

    public function customer()
    {
        return $this->excel->download(new CustomerExport, 'IPI_Customer_' . uniqid() . '.xlsx');
    }

    public function visit()
    {
        return $this->excel->download(new VisitExport, 'IPI_Kunjungan_' . uniqid() . '.xlsx');
    }

    public function modality()
    {
        return $this->excel->download(new ModalityExport, 'IPI_Modality_' . uniqid() . '.xlsx');
    }

    public function pacsReport()
    {
        $pacsInstallationId = [10, 5, 6, 7];
        return $this->excel->download(new PacsReportMultiSheetExport($pacsInstallationId), 'IPI_Intiwid_' . date('Ymd') . '.xlsx');
    }
}
