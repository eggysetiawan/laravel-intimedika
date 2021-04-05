<?php

namespace App\Http\Controllers;

use App\DataTables\TargetDataTable;

class SelectYearController extends Controller
{

    public function __invoke(TargetDataTable $dataTable)
    {
        return $dataTable->with([
            'selectedYear' => request('year'),
        ])
            ->render('targets.index', [
                'selectedYear' => request('year')
            ]);
    }
}
