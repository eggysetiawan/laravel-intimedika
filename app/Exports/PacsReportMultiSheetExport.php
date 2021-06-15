<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PacsReportMultiSheetExport implements WithMultipleSheets
{
    private $pacsInstallationId = [];

    public function __construct(array $pacsInstallationId)
    {
        $this->pacsInstallationId = $pacsInstallationId;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->pacsInstallationId as $id) {
            $sheets[] = new PacsReportExport($id);
        }
        return $sheets;
    }
}
