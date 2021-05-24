<?php

namespace App\Services;

use App\Hospital;
use App\PacsEngineer;
use Illuminate\Support\Str;

class PacsInstallationService
{
    private $pacs_installations;

    public function createPacsInstallation($request)
    {
        $attr = $request->validated();
        $hospital_name = Hospital::findOrFail(request('hospital'))->name;
        $attr['slug'] = Str::slug($hospital_name . ' ' . now()->format('Y'));
        $attr['handover_date'] = date('Y-m-d H:i:s', strtotime($request->handover_date));
        $attr['start_installation_date'] = date('Y-m-d H:i:s', strtotime($request->start_installation_date));
        $attr['training_date'] = date('Y-m-d H:i:s', strtotime($request->training_date));
        $attr['finish_installation_date'] = date('Y-m-d H:i:s', strtotime($request->finish_installation_date));
        $attr['hospital_id'] = $request->hospital;

        return $this->pacs_installations = auth()->user()->pacs_installs()->create($attr);
    }

    public function insertEngineer($request)
    {
        $engineers = [];
        foreach ($request->pacs_engineers as $engineer) {
            $engineers =   PacsEngineer::insert([
                'engineerable_id' => $this->pacs_installations->id,
                'engineerable_type' => 'App\PacsInstallation',
                'user_id' => $engineer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $engineers;
    }

    public function uploadFiles()
    {
        return $this->pacs_installations
            ->addMultipleMediaFromRequest(['img'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('files');
            });
    }
}
