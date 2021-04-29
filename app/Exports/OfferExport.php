<?php

namespace App\Exports;

use App\Services\ExcelService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class OfferExport implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    /**
     * @return Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $offers = ExcelService::getOffers();

        return view('exports.excel.offer', [
            'offers' => $offers,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => '_-Rp* #,##0_-;-Rp* #,##0_-;_-Rp* "-"_-;_-@_-',
            'I' => '_-Rp* #,##0_-;-Rp* #,##0_-;_-Rp* "-"_-;_-@_-',
            'J' => '_-Rp* #,##0_-;-Rp* #,##0_-;_-Rp* "-"_-;_-@_-',
        ];
    }
}
