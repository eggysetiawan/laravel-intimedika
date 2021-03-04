<?php

namespace App\Http\Controllers;

use App\DataTables\OfferDataTable;

class OfferCompletedController extends Controller
{

    public function __invoke(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'complete' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Penawaran Berhasil',
                'approval' => 0
            ]);
    }
}
