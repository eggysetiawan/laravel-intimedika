<?php

namespace App\Exports;

use App\PacsInstallation;
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

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return PacsInstallation::query()
            ->with('supports')
            ->where('id', $this->id);
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
                $pacsInstallation->hospital->name,
                $pacsInstallation->hospital->city
            ],
            [],
            [
                $pacsInstallation->start_installation_date
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
                $event->sheet->getStyle('B2:C2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('B3:C17')->applyFromArray([
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
            },
        ];
    }
    public function startCell(): string
    {
        return 'B2';
    }
}
