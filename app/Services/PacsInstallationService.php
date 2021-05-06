<?php

namespace App\Services;

class PacsInstallationService
{

    public function createPacsInstallation($request)
    {
        $attr = $request->all();
        $hospital_name = Hospital::findOrFail(request('hospital'))->name;
        $attr['slug'] = Str::slug($hospital_name . ' ' . now()->format('Y'));
        $attr['handover_date'] = date('Y-m-d H:i:s', strtotime($request->handover_date));
        $attr['start_installation_date'] = date('Y-m-d H:i:s', strtotime($request->start_installation_date));
        $attr['training_date'] = date('Y-m-d H:i:s', strtotime($request->training_date));
        $attr['finish_installation_date'] = date('Y-m-d H:i:s', strtotime($request->finish_installation_date));
        $attr['hospital_id'] = $request->hospital;
    }
}
