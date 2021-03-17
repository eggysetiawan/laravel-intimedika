<?php

namespace App\Http\Controllers;

use App\DataTables\OfferDataTable;
use App\Services\FilterService;

class OfferCompletedController extends Controller
{

    public function __invoke(OfferDataTable $dataTable, FilterService $filterService)
    {
        return $dataTable
            ->with([
                'complete' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Penawaran Berhasil',
                'approval' => 0,
                'fromDate' => $filterService->getOfferFromDate(),
            ]);
    }
}
