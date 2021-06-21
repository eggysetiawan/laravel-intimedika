<?php

namespace App\Exports;

use App\PacsInstallation;
use App\PacsSupport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PacsReportExport implements
    ShouldAutoSize,
    WithMapping,
    // WithHeadings,
    WithEvents,
    FromQuery,
    WithCustomStartCell
{

    public int $id;
    public $totalRow;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        $pacsInstallation =  PacsInstallation::query()
            ->with('supports')
            ->where('id', $this->id);

        return $pacsInstallation;
    }


    public function getTotalSupportRow()
    {
        return PacsSupport::where('pacs_installation_id', $this->id)->count() + 6;
    }

    public function map($pacsInstallation): array
    {
        $rows = [];
        foreach ($pacsInstallation->supports as $support) {
            $rows[] = [
                $support->report_date->format('d F, Y'),
                $support->problem,
            ];
        }

        $pacsInstallationRows = [
            [
                'Rumah Sakit :',
                $pacsInstallation->hospital->name
            ],
            [
                'Kota :',
                $pacsInstallation->hospital->city
            ],
            [
                'Alamat',
                $pacsInstallation->hospital->address
            ],
            [],
            [
                'Tanggal',
                'Kegiatan'
            ]


        ];

        $finalArray = array_merge($pacsInstallationRows, $rows);

        return $finalArray;
    }



    // public function headings(): array
    // {
    //     return [
    //         'Tanggal',
    //         'Kegiatan'
    //     ];
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getStyle('B6:C6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ]);

                $event->sheet->getStyle('B7:B' . $this->getTotalSupportRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('C7:C' . $this->getTotalSupportRow())->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
    public function startCell(): string
    {
        return 'B2';
    }
}
