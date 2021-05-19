<?php

namespace App\Http\Controllers;

use App\PacsInstallation;
use Illuminate\Http\Request;
use App\Http\Requests\SelectHospitalRequest;
use App\Http\Resources\SelectInstallationResource;

class SelectInstallationController extends Controller
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
            $pacs =  PacsInstallation::whereHas('hospital')->get();
        }

        if ($search) {
            $pacs = PacsInstallation::selectInstallation($search);
        }
        $response = SelectInstallationResource::collection($pacs);
        return response()->json($response);
    }
}
