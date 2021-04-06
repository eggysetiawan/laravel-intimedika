<?php

namespace App\Services;

use Illuminate\Support\Str;


class TargetService
{
    public function createTarget($request)
    {
        return auth()->user()->targets()->create([
            'slug' => Str::slug(auth()->user()->name . ' ' . $request->year),
            'year' => $request->year,
            'target' => str_replace([",", "_"], "", $request->target)
        ]);
    }
}
