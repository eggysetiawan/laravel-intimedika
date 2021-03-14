<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Hospital;
use App\Http\Requests\VisitRequest;
use App\Services\VisitAddService;

class VisitAddController extends Controller
{

    public function create()
    {
        return view('visits.add', [
            'customer' => new Customer(),
            'hospitals' => Hospital::selectHospital(),
        ]);
    }


    public function store(VisitRequest $request, VisitAddService $visitAddService)
    {
        $visitAddService->createCustomer($request);
        $visitAddService->attachHospital();
        $visitAddService->addVisit($request);
        $visitAddService->uploadImage();
        // alert success
        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');
        // redirect to index visits
        return redirect('visits');
    }
}
