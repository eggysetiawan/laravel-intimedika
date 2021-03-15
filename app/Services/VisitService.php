<?php

namespace App\Services;

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
        // validate input
        $attr = $request->all();
        $attr['slug'] = $this->setSlug();
        // customer_id
        $attr['customer_id'] = $request->customer;
        $attr['is_visited'] = 1;

        // insert
        return auth()->user()->visits()->create($attr);
    }

    public function update($request, $visit)
    {
        $imgSlug = $this->setSlug() . '.' . request()->file('img')->extension();

        $visit
            ->addMediaFromRequest('img')
            ->usingFileName($imgSlug)
            ->toMediaCollection('images');


        $attr = $request->all();
        return $visit->update($attr);
    }
}
