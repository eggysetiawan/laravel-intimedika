<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\SelectHospitalRequest;
use App\Http\Resources\SelectCustomerResource;

class SelectCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SelectHospitalRequest $request)
    {
        $search = $request->search;

        if (!$search) {
            $customers = Customer::selectCustomer();
        }

        if ($search) {
            $customers =  Customer::selectAllCustomer($search);
        }

        $response = SelectCustomerResource::collection($customers);
        return response()->json($response);
    }
}
