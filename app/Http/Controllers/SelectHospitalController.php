<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Http\Requests\SelectHospitalRequest;
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
            $hospitals =  Hospital::select(['id', 'name'])
                ->orderBy('name', 'asc')
                ->where('name', '!=', '')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($hospitals as $hospital) {
            $response[] = array(
                'id' => $hospital->id,
                'text' => $hospital->name,
            );
        }

        echo json_encode($response);
        exit;
    }
}
