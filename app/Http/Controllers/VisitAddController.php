<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\VisitRequest;
use App\Services\VisitAddService;

class VisitAddController extends Controller
{

    public function create()
    {
        return view('visits.add', [
            'customer' => new Customer(),
        ]);
    }


    public function store(VisitRequest $request, VisitAddService $visitAddService)
    {
        $visitAddService->createCustomer($request);
        $visitAddService->attachHospital();
        $visitAddService->addVisit($request);

        if (request('img')) {
            $visitAddService->uploadImage();
        }

        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');
        return redirect('visits');
    }
}
