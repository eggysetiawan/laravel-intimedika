<?php

namespace App\Services;

use App\Exports\PacsReportExport;
use Illuminate\Support\Str;

class VisitService
{
    public function setSlug()
    {
        $timestamp = date('YmdHis');
        return Str::slug(request('request') . ' ' . $timestamp);
    }


    public function create($request)
    {
        $attr = $request->validated();
        $attr['slug'] = $this->setSlug();
        $attr['customer_id'] = $request->customer;
        $attr['is_visited'] = 1;

        // insert
        $visits = auth()->user()->visits()->create($attr);
        $imgSlug = uniqid() . '.' . request()->file('img')->extension();

        $visits
            ->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('images');
    }

    public function update($request, $visit)
    {
        $imgSlug = uniqid() . '.' . request()->file('img')->extension();
        $visit
            ->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('images');

        $attr = $request->validated();
        return $visit->update($attr);
    }
}
