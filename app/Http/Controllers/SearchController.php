<?php

namespace App\Http\Controllers;

use App\Visit;
use App\Hospital;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\OfferDataTable;
use App\DataTables\HospitalDataTable;
use App\DataTables\PacsInstallationDataTable;
use App\Http\Requests\SearchPacsInstallationRequest;

class SearchController extends Controller
{
    public function visit()
    {
        $query = Str::slug(request('query'), '-');
        $visits = Visit::where("visits.slug", "like", "%$query%")
            ->with('customer', 'author')
            ->latest()
            ->paginate(5);
        return view('visits.index', compact('visits'));
    }

    public function hospital(HospitalDataTable $dataTable)
    {
        $from = date('Y-m-d', strtotime(request('from')));
        $to = date('Y-m-d', strtotime(request('to')));

        return $dataTable->with([
            'from' => $from,
            'to' => $to,
        ])
            ->render('hospitals.index');
    }
    public function offer(OfferDataTable $dataTable)
    {
        $from = date('Y-m-d', strtotime(request('from')));
        $to = date('Y-m-d', strtotime(request('to')));

        return $dataTable->with([
            'from' => $from,
            'to' => $to,
        ])
            ->render('offers.index', [
                'approval' => '',
            ]);
    }
    public function offerCompleted(OfferDataTable $dataTable)
    {
        $from = date('Y-m-d', strtotime(request('from')));
        $to = date('Y-m-d', strtotime(request('to')));

        return $dataTable->with([
            'from' => $from,
            'to' => $to,
            'complete' => true,
        ])
            ->render('offers.index');
    }

    public function pacsInstallation(SearchPacsInstallationRequest $request, PacsInstallationDataTable $dataTable)
    {
        return $dataTable->with([
            'hospital' => $request->hospital,
        ])->render('pacs.installation.index', [
            'hospitals' => Hospital::intiwidHospital(),
        ]);
    }
}
