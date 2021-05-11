<?php

namespace App\Services;

use App\PacsEngineer;
use App\PacsInstallation;
use Illuminate\Support\Str;

class PacsSupportService
{
    private $pacs_supports;

    public function createPacsSupport($request)
    {
        $attr = $request->all();
        $hospital_name = PacsInstallation::hospitalRequest($request);

        $attr['slug'] = Str::slug($hospital_name . '-' . uniqid());
        $attr['pacs_installation_id'] = $request->pacs_installation;
        return $this->pacs_supports = auth()->user()->pacs_supports()->create($attr);
    }

    public function createEngineers($request)
    {
        $engineers = [];
        foreach ($request->pacs_engineers as $engineer) {
            $engineers = PacsEngineer::insert([
                'engineerable_id' => $this->pacs_supports->id,
                'engineerable_type' => 'App\PacsSupport',
                'user_id' => $engineer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $engineers;
    }

    public function getEngineers($pacsSupport)
    {
        $technicians = $pacsSupport->engineers;
        $names = array();
        foreach ($technicians as $technician) :
            $names[] = $technician->technician->name;
        endforeach;
        return join(" & ", array_unique($names));
    }
}
