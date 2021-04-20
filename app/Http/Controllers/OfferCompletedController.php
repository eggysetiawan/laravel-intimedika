<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Services\FilterService;
use App\DataTables\OfferDataTable;

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
                'completedCount' => Offer::whereHas('progress', function ($query) {
                    return $query->where('progress', 100);
                })->count(),
            ]);
    }
}
