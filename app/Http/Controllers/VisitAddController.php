<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Services\VisitAddService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VisitRequest;

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
        DB::transaction(function () use ($request, $visitAddService) {

            $visitAddService->createCustomer($request);
            $visitAddService->attachHospital();
            $visitAddService->addVisit($request);

            if (request('img')) {
                $visitAddService->uploadImage();
            }
        });


        session()->flash('success', 'Kunjungan Baru Berhasil di Buat!');
        return redirect('visits');
    }
}
