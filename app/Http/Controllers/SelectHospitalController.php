<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Http\Requests\SelectHospitalRequest;
use App\Http\Resources\SelectHospitalResource;
use Illuminate\Http\Request;

class SelectHospitalController extends Controller
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
            $hospitals = Hospital::selectHospital();
        }

        if ($search) {
            $hospitals =  Hospital::select(['id', 'name', 'city'])
                ->orderBy('name', 'asc')
                ->whereNotNull('name')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%')
                ->limit(20)
                ->get();
        }

        $response = SelectHospitalResource::collection($hospitals);
        return response()->json($response);
    }
}